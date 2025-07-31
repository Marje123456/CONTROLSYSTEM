<?php

namespace App\Http\Controllers;

use App\Models\AuditMachine;
use App\Models\Machine;
use App\Models\Machinespayment;
use App\Models\Premise;
use App\Models\Prosecutor;
use App\Models\Statusmachine;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

use Carbon\Carbon;

class MachineController extends Controller
{
    public $datenow;
    public $status_machine;
    public $datestatus_machine;


    public function __construct()
    {
        $this->middleware('can:cambio_estatus_maquina')->only('statusmachine');
        $this->middleware('can:auditorias')->only('auditeject');
        $this->middleware('can:auditorias')->only('auditview');
        $this->middleware('can:auditorias')->only('auditindexmachine');
        $this->middleware('can:auditorias')->only('auditprubmachine');
        $this->middleware('can:registrar_rlm')->only('create');
        $this->middleware('can:registrar_rlm')->only('store');
        $this->middleware('can:reportes')->only('index');
        $this->middleware('can:pagos_maquina')->only('viewpayment');
        $this->middleware('can:pagar_maquina')->only('payment');
        $this->middleware('can:editaryeliminar_maquina')->only('edit');
        $this->middleware('can:editaryeliminar_maquina')->only('update');
        $this->middleware('can:editaryeliminar_maquina')->only('destroy');
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        /* $payments = Machinespayment::all(); */
        $machines = Machine::all();

        $datenow = Carbon::now()->format('Y-m-d');

        foreach ($machines as $machine) {
            if (isset($machine->payment_date) && $machine->payment_date->format('Y-m-d') <= $datenow) {
                $monthpayment = $machine->payment_date->format('m');
                $yearpayment = $machine->payment_date->format('Y');
                $daypayment = $machine->payment_date->format('d');

                $valuepayment = Machinespayment::where("code_machine", $machine->code)
                    ->where("month_pay", $monthpayment)
                    ->where("year_pay", $yearpayment)
                    ->first();
                /* dd($monthpayment, $yearpayment,$valuepayment->code_machine, $valuepayment->month_pay, $valuepayment->year_pay); */

                if (is_null($valuepayment)) {
                } else {

                    $paymentday = $machine->payment_date->format('Y-m-d');
                    $summes = Carbon::parse($paymentday)->addMonth()->format('Y-m-d');
                    $machine->payment_date = $summes;
                    $machine->active_status = "1";
                    $machine->forfeiture_status = "0";
                    $machine->penalty_status = "0";
                    $machine->debit_status = "0";
                    $machine->save();
                }
            }



            if (isset($machine->payment_date)) {
                $machinepayment_date = $machine->payment_date->format('Y-m-d');

                $statusmachine = Statusmachine::find(1);

                $datestatus_machineforfeiture = $machine->payment_date->addDay($statusmachine->forfeiture_days);

                $datestatusmachineforfeiture = $datestatus_machineforfeiture->format('Y-m-d');
                $datestatus_machinepenalty = $machine->payment_date->addDay($statusmachine->penalty_days);
                $datestatusmachinepenalty = $datestatus_machinepenalty->format('Y-m-d');

                switch (true) {
                    case ($datestatusmachineforfeiture <= $datenow):
                        $machine->forfeiture_status = "1";
                        $machine->save();
                        break;
                    case ($datestatusmachinepenalty <= $datenow):
                        $machine->penalty_status = "1";
                        $machine->save();
                        break;
                    case (isset($machine->payment_date) && $machine->payment_date->format('Y-m-d') <= $datenow):
                        $monthpayment = $machine->payment_date->format('m');
                        $yearpayment = $machine->payment_date->format('Y');

                        $valuepayment = Machinespayment::where("code_machine", $machine->code)
                            ->where("month_pay", $monthpayment)
                            ->where("year_pay", $yearpayment)
                            ->first();
                        if (!isset($valuepayment->code_machine)) {
                            $machine->debit_status = "1";
                            $machine->save();
                        }

                        break;
                    default:
                        # code...
                        break;
                }
            }
        }
        return view('machine.index', compact('machines'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $premises = Premise::all();
        return view('machine.create', compact('premises'));
    }

    public function createt(Premise $premise)
    {
        //
        $premise = Premise::where("ident", $premise->ident)
            ->first();

        return view('machine.create', compact('premise'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $serialeunique = Machine::where("seriale", $request->seriale)->first();
        if (!$serialeunique) {
            
            $request->validate([
                'responsible' => 'min:2|max:15',
                'premise_ident' => 'min:2|max:15',
                'model' => 'min:2|max:15',
                'brand' => 'min:2|max:15',
                'seriale' => 'min:3|max:100'
            ]);

            $lastmachine = Machine::latest('id')->first();
            if (isset($lastmachine->id)) {
                $lastmachineint = (int) $lastmachine->id;
                $lastmachinemore = $lastmachineint + 1;
            } else {
                $lastmachinemore = 1;
            }
            $premiseident = $request->premise_ident;
            $code = $premiseident . "-M" . $lastmachinemore;

            $machine = new Machine;
            $machine->premise_ident = $request->premise_ident;
            $machine->code = $code;
            $machine->model = $request->model;
            $machine->brand = $request->brand;
            $machine->seriale = $request->seriale;
            $machine->responsible = $request->responsible;
            $machine->save();

            $premise = Premise::where("ident", $request->premise_ident)
                ->first();
            return redirect()->route('machine.createt', $premise)->with('storemachine', 'OK');
        } else {
            return back()->with('serialeduplicate','OK');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Machine $machine)
    {
        //
        return view('machine.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Machine $machine)
    {
        //
        return view('machine.edit', compact('machine'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Machine $machine)
    {
        //
        $request->validate([
            'premise_ident' => 'required|min:2|max:15',
            'code' => 'required|min:2|max:15',
            'model' => 'required|min:2|max:15',
            'brand' => 'required|min:2|max:15',
            'seriale' => 'required|min:3|max:15'
        ]);

        $machine->update($request->all());
        return redirect()->route('machine.index')->with('editmachine', 'OK');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Machine $machine)
    {
        //
        Machine::destroy($machine->id);
        return redirect()->route('machine.index')->with('delete', 'OK');
    }

    public function payment(Machine $machine)
    {
        //
        $year = Carbon::now()->format('Y');

        return view('machine.payment', compact('machine', 'year'));
    }

    public function paymenteject(Request $request, Machine $machine)
    {
        //
        $code_machine = $machine->id;
        $datenow = Carbon::now()->format('Y-m-d');

        $chekes = $request->month_pay;

        foreach ($chekes as $month_payone) {
            $Machinespayment = new Machinespayment;
            $Machinespayment->code_machine = $request->code_machine;
            $Machinespayment->amount = $request->amount;
            $Machinespayment->payment_date = $datenow;
            $Machinespayment->reference = $request->reference;
            $Machinespayment->month_pay = $month_payone;
            $Machinespayment->year_pay = $request->selectyears;
            $Machinespayment->save();
        }


        return redirect()->route('machine.index')->with('payment', 'OK');
    }

    public function statusmachine()
    {
        //

        $statusmachine = Statusmachine::find(1);
        return view('machine.statusmachine', compact('statusmachine'));
    }

    public function updatestatusmachine(Request $request, Statusmachine $statusmachine)
    {
        $statusmachine = Statusmachine::find(1);
        $statusmachine->penalty_days = $request->penalty_days;
        $statusmachine->forfeiture_days = $request->forfeiture_days;
        $statusmachine->save();

        return redirect()->route('machine.statusmachine')->with('statusdays', 'OK');
    }

    public function taxmachine()
    {
        //

        $statusmachine = Statusmachine::find(1);
        return view('machine.taxmachine', compact('statusmachine'));
    }

    public function updatetaxmachine(Request $request, Statusmachine $statusmachine)
    {
        $statusmachine = Statusmachine::find(1);
        $statusmachine->machine_tax = $request->machine_tax;
        $statusmachine->save();

        return redirect()->route('machine.taxmachine')->with('tax', 'OK');
    }


    public function viewpayments(Machine $machine)
    {
        //
        $machinespayments = Machinespayment::where("code_machine", $machine->code)->get();

        /* $machinespayments = Machinespayment::all(); */
        return view('machine.paymentsmachine', compact('machinespayments'));
    }

    public function auditprubmachine()
    {

        return redirect()->route('machine.auditviewmachine', 1);
        /* return view('premise.auditview', compact('premise')); */
    }

    public function auditindexmachine()
    {
        $auditmachines = AuditMachine::all();
        return view('machine.auditindexmachine', compact('auditmachines'));
    }


    public function auditview(Machine $machine)
    {
        $machine = Machine::where("id", $machine->id)
            ->first();

        return view('machine.audit', compact('machine'));
    }

    public function auditeject(Request $request)
    {

        $mailprosecutor = auth()->user()->email;
        $prosecutor = Prosecutor::where("email", $mailprosecutor)
            ->first();
        $machine = Machine::where("code", $request->code)
            ->first();

        $auditmachine = new Auditmachine;
        $auditmachine->code = $request->code;
        $auditmachine->ident = $request->premise_ident;
        $auditmachine->idc = $prosecutor->idc;
        $auditmachine->audit_date = Carbon::now()->format('Y-m-d');
        $auditmachine->note = $request->note;
        $auditmachine->save();

        return redirect()->route('machine.auditindexmachine')->with('auditeject', 'OK');
    }

    public function indexpdfmach()
    {
        $machines = Machine::all();

        $pdf = Pdf::loadView('machine.indexpdf', compact('machines'))->setPaper('a4', 'portrait');
        return $pdf->stream('machinesreport.pdf');
    }


    public function reportgraf()
    {
        return view('machine.reportgraf');
    }

    public function reportgrafconsult()
    {
        $machines = Machine::all();

        $data = [];

        $countQrNopago = 0;
        $countOrdenImp = 0;
        $countQRImp = 0;
        $countInactiva = 0;
        $countConfiscada = 0;
        $countMultada = 0;
        $countDeudora = 0;
        $countActiva = 0;
        $countListo = 0;

        foreach ($machines as $machine) {
            switch (true) {
                case ($machine->qr_status == 0):
                    $countQrNopago++;
                    break;
                case ($machine->qr_status == 1):
                    $countOrdenImp++;
                    break;
                case ($machine->qr_status == 2):
                    $countQRImp++;
                    break;
                case ($machine->active_status == 0):
                    $countInactiva++;
                    break;
                case ($machine->forfeiture_status == 1):
                    $countConfiscada++;
                    break;
                case ($machine->penalty_status == 1):
                    $countMultada++;
                    break;
                case ($machine->debit_status == 1):
                    $countDeudora++;
                    break;
                case ($machine->active_status == 1):
                    $countActiva++;
                    break;


                default:
                    # code...
                    break;
            }
        }

        $new_status = array('status' => 'Qr No pago', 'value' => $countQrNopago);
        array_push($data, $new_status);
        $new_status = array('status' => 'Orden de Imp', 'value' => $countOrdenImp);
        array_push($data, $new_status);
        $new_status = array('status' => 'Por Activar', 'value' => $countQRImp);
        array_push($data, $new_status);
        $new_status = array('status' => 'Inactiva', 'value' => $countInactiva);
        array_push($data, $new_status);
        $new_status = array('status' => 'Confiscadas', 'value' => $countConfiscada);
        array_push($data, $new_status);
        $new_status = array('status' => 'Multadas', 'value' => $countMultada);
        array_push($data, $new_status);
        $new_status = array('status' => 'Deudora', 'value' => $countDeudora);
        array_push($data, $new_status);
        $new_status = array('status' => 'Activa/Solvente', 'value' => $countActiva);
        array_push($data, $new_status);

        /* return view('machine.reportgraf', compact('data')); */
        return response()->json($data, 200);
    }
}
