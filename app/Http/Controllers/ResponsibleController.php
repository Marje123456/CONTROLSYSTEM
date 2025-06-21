<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\Machine;
use App\Models\Machinespayment;
use App\Models\Paymenttype;
use App\Models\Premise;
use App\Models\Receipt;
use App\Models\Responsible;
use App\Models\Statusmachine;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;

class ResponsibleController extends Controller
{
    public $mounttotalpay;
    public $datenow;

    public function __construct()
    {
        $this->middleware('can:registrar_rlm')->only('create');
        $this->middleware('can:registrar_rlm')->only('store');
        $this->middleware('can:reportes')->only('index');
        $this->middleware('can:editaryeliminar_representante')->only('edit');
        $this->middleware('can:editaryeliminar_representante')->only('update');
        $this->middleware('can:editaryeliminar_representante')->only('destroy');
    }

    /**
     * Display a listing of the resource. Mostrar un listado del recurso. Leer todos los registros / Mostrar
     */
    public function index()
    {
        //
        $responsibles = Responsible::all();
        return view('responsible.index', compact('responsibles'));
    }

    /**
     * Show the form for creating a new resource. Muestra el formulario para crear un nuevo recurso. Formulario para nuevo registro
     */
    public function create()
    {
        //

        return view('responsible.create');
    }

    /**
     * Store a newly created resource in storage. Almacena un recurso recién creado en el almacén. Guardar en sb el nuevo registro
     */
    public function store(Request $request)
    {
        //
        $idcunique = Responsible::where("idc", $request->idc)->first();
        $emailunique = Responsible::where("email", $request->email)->first();
        if (!$idcunique && !$emailunique) {
            $request->validate([
                'idc' => 'required|min:6|max:15',
                'names' => 'required|min:3|max:50',
                'last_names' => 'required|min:3|max:50',
                'phone' => 'min:8|max:20'
            ]);
            /* return $request->all(); */
            $usero = new User;
            $usero->name = $request->names;
            $usero->email = $request->email;
            $usero->password = $request->idc;
            $usero->save();

            $responsible = new Responsible;
            $responsible->idc = $request->idc;
            $responsible->names = $request->names;
            $responsible->last_names = $request->last_names;
            $responsible->phone = $request->phone;
            $responsible->email = $request->email;
            $responsible->save();

            /*LOGBOOK */
            $detailconstruction = "Data= IDC: " . $request->idc . "| Name: " . $request->names . " " . $request->last_names;
            $logbook = new Logbook;
            $logbook->email_user = auth()->user()->email;
            $logbook->activity = "Registrer Responsible";
            $logbook->detail = $detailconstruction;
            $logbook->date_activity = Carbon::now();
            $logbook->save();
            /*END LOGBOOK */

            $responsible = Responsible::where("idc", $request->idc)
                ->first();
            return redirect()->route('premise.createt', $responsible)->with('store', 'OK');

            /* return redirect()->route('responsible.index')->with('store','OK'); */
        } else {
            if ($idcunique) {
                return back()->with('idcduplicate', 'OK');
            } else {
                return back()->with('emailduplicate', 'OK');
            }
        }
    }

    /**
     * Display the specified resource. Muestra el recurso especificado. Visualizar un registro especifico
     */
    public function show(Responsible $responsible)
    {
        //
        return view('responsible.show');
    }

    /**
     * Show the form for editing the specified resource. Mostrar el formulario para editar el recurso especificado. 
     */
    public function edit(Responsible $responsible)
    {
        //
        return view('responsible.edit', compact('responsible'));
    }

    /**
     * Update the specified resource in storage. Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(Request $request, Responsible $responsible)
    {
        //
        $request->validate([
                'idc' => 'required|min:6|max:15',
                'names' => 'required|min:3|max:50',
                'last_names' => 'required|min:3|max:50',
                'phone' => 'min:8|max:32'
            ]);

        $responsible->update($request->all());

        /*LOGBOOK */
        $detailconstruction = "Data= IDC: " . $request->idc . "| Name: " . $request->names . " " . $request->last_names;
        $logbook = new Logbook;
        $logbook->email_user = auth()->user()->email;
        $logbook->activity = "Update Responsible";
        $logbook->detail = $detailconstruction;
        $logbook->date_activity = Carbon::now();
        $logbook->save();
        /*END LOGBOOK */


        return redirect()->route('responsible.index')->with('edit', 'OK');
    }

    /**
     * Remove the specified resource from storage. Elimina el recurso especificado del almacenamiento.
     */
    public function destroy(Responsible $responsible)
    {
        //
        $responsible->delete();

        /*LOGBOOK */
        $detailconstruction = "Data= IDC: " . $responsible->idc . "| Name: " . $responsible->names . " " . $responsible->last_names;
        $logbook = new Logbook;
        $logbook->email_user = auth()->user()->email;
        $logbook->activity = "Delete Responsible";
        $logbook->detail = $detailconstruction;
        $logbook->date_activity = Carbon::now();
        $logbook->save();
        /*END LOGBOOK */


        return redirect()->route('responsible.index')->with('delete', 'OK');
    }

    public function responsiblepayment()
    {
        $mailuser = auth()->user()->email;

        $responsible = Responsible::where("email", $mailuser)->first();
        return redirect()->route('responsible.paymachinesview', $responsible);
    }


    public function paymachinesview(Responsible $responsible)
    {
        if (isset($responsible)) {
            $responsible = $responsible;
        } else {
            $mailuser = auth()->user()->email;
            $responsible = User::where("email", $mailuser)->first();
        }


        $mounttotalpay = 0;

        $statusmachine = Statusmachine::find(1);
        $machinetax = $statusmachine->machine_tax;

        $machines = Machine::where("responsible", $responsible->idc)
            ->where("qr_status", 3)
            ->get();

        foreach ($machines as $machine) {
            $mountpay = $machine->debitactivation;
            $mounttotalpay = $mounttotalpay + $mountpay;
        }

        $idreceipt = Machinespayment::latest('id_receipt')->first();
        if (isset($idreceipt->id_receipt)) {
            $idreceiptint = (int) $idreceipt->id_receipt;
            $idreceiptmore = $idreceiptint + 1;
        } else {
            $idreceiptmore = 1;
        }

        $paymentstype = Paymenttype::all();

        return view('responsible.paymachines', compact('responsible', 'machines', 'mounttotalpay', 'idreceiptmore', 'paymentstype'));
    }

    public function ejectpaymachines(Request $request)
    {
        $mounttotalpay = 0;

        $statusmachine = Statusmachine::find(1);
        $machinetax = $statusmachine->machine_tax;

        $machines = Machine::where("responsible", $request->responsible)
            ->where("qr_status", 3)
            ->get();

        foreach ($machines as $machine) {
            $machinevalue = Machine::where("code", $machine->code)
                ->first();

            $monthpayment = $machine->payment_date->format('m');
            $yearpayment = $machine->payment_date->format('Y');


            if ($monthpayment == 12) {
                $montpayment = '01';
                $yearpayment = $yearpayment + 1;
                $machinepayment_date = $yearpayment . '-' . $montpayment . '-02';
            } else {
                $montpaymentF = $monthpayment + 1;
                $machinepayment_date = $yearpayment . '-' . $montpaymentF . '-02';
            }
            $machinevalue->payment_date = $machinepayment_date;
            $machinevalue->debitactivation = $statusmachine->machine_tax;
            $machinevalue->daydebitactivation = 0;
            $machinevalue->save();

            $datenow = Carbon::now()->format('Y-m-d');

            $Machinespayment = new Machinespayment;
            $Machinespayment->code_machine = $machinevalue->code;
            $Machinespayment->amount = $machine->debitactivation;
            $Machinespayment->payment_date = $datenow;
            $Machinespayment->month_pay = $monthpayment;
            $Machinespayment->year_pay = $yearpayment;
            $Machinespayment->reference = $request->reference;
            $Machinespayment->paymenttype = $request->paymenttype;
            $Machinespayment->id_receipt = $request->id_receipt;
            $Machinespayment->idc_responsible = $request->responsible;
            $Machinespayment->save();
        }


        $iduserbox = auth()->user()->id;
        $Receipt = new Receipt;
        $Receipt->userbox = $iduserbox;
        $Receipt->reference = $request->reference;
        $Receipt->total_amount = $request->mounttotalpay;
        $Receipt->payment_date = $datenow;
        $Receipt->paymenttype = $request->paymenttype;
        $Receipt->save();

        $responsible = $request->responsible;
        /* return redirect()->route('responsible.index')->with('pay','OK'); */
        return redirect()->route('responsible.receiptpdf', $responsible);
    }


    public function receiptpayment(Responsible $responsible)
    {
        $idreceiptconsult = Machinespayment::latest('id_receipt')->first();

        $receipt = Receipt::latest('id')->first();

        $paymenttype = Paymenttype::where("id", $idreceiptconsult->paymenttype)->first();

        $responsible = Responsible::where("idc", $idreceiptconsult->idc_responsible)->first();

        $machinespayments = Machinespayment::where("id_receipt", $idreceiptconsult->id_receipt)->get();


        $pdf = Pdf::loadView('responsible.receipt', compact('machinespayments', 'idreceiptconsult', 'responsible', 'paymenttype', 'receipt'))->setPaper('a6', 'portrait');
        return $pdf->stream('recibopago.pdf');
    }

    public function receiptpdf(Responsible $responsible)
    {
        $idreceiptconsult = Machinespayment::latest('id_receipt')->first();

        $receipt = Receipt::latest('id')->first();

        $paymenttype = Paymenttype::where("id", $idreceiptconsult->paymenttype)->first();

        $responsible = Responsible::where("idc", $idreceiptconsult->idc_responsible)->first();

        $machinespayments = Machinespayment::where("id_receipt", $idreceiptconsult->id_receipt)->get();

        return view('responsible.receiptpdf', compact('machinespayments', 'idreceiptconsult', 'responsible', 'paymenttype', 'receipt'));
    }


    public function reportall()
    {
        $responsibles = Responsible::all();
        $premises = Premise::all();
        $machines = Machine::all();

        return view('responsible.reportall', compact('responsibles', 'premises', 'machines'));
    }

    public function reportallpdf()
    {
        $responsibles = Responsible::all();
        $premises = Premise::all();
        $machines = Machine::all();

        return view('responsible.reportall', compact('responsibles', 'premises', 'machines'));
    }

    public function indexpdfresp()
    {
        $responsibles = Responsible::all();

        $pdf = Pdf::loadView('responsible.indexpdf', compact('responsibles'))->setPaper('a4', 'portrait');
        return $pdf->stream('responsiblesreport.pdf');
    }
}
