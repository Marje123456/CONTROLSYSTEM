<?php

namespace App\Http\Controllers;

use App\Models\Premise;
use App\Models\Prosecutor;
use App\Models\Responsible;
use App\Models\Auditpremise;
use App\Models\City;
use App\Models\Department;
use App\Models\Logbook;
use App\Models\Machine;
use App\Models\Neighborhood;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PremiseController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:auditorias')->only('auditeject');
        $this->middleware('can:auditorias')->only('auditview');
        $this->middleware('can:auditorias')->only('auditindex');

        $this->middleware('can:auditorias')->only('auditprub');
        $this->middleware('can:registrar_rlm')->only('create');
        $this->middleware('can:registrar_rlm')->only('store');
        $this->middleware('can:reportes')->only('index');
        $this->middleware('can:editaryeliminar_local')->only('edit');
        $this->middleware('can:editaryeliminar_local')->only('update');
        $this->middleware('can:editaryeliminar_local')->only('destroy');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $premises = Premise::all();
        $departments = Department::all();
        $cities = City::all();
        $neighborhoods = Neighborhood::all();
        return view('premise.index', compact('premises', 'departments', 'cities', 'neighborhoods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Responsible $responsible)
    {
        //

        return view('premise.create', compact('responsible'));
    }

    public function createt(Responsible $responsible)
    {
        //

        $responsible = Responsible::where("idc", $responsible->idc)
            ->first();


        return view('premise.create', compact('responsible'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $rutunique = Premise::where("rut", $request->rut)->first();
        $patentunique = Premise::where("patent", $request->patent)->first();
        if (!$rutunique && !$patentunique) {
            $request->validate([
                    'idc' => 'required|min:6|max:15',
                    'rut' => 'required|min:2|max:50',
                    'patent' => 'required|min:2|max:15',
                    'email' => 'min:3|max:50'
                ]);


            /*Latitude*/
            $latitude = $request->latitude;

            list($entero1, $decimal1) = explode(".", $latitude);
            $datolatitude1 = $entero1;

            $val = ("0." . $decimal1) * 60;
            list($entero2, $decimal2) = explode(".", $val);
            $datolatitude2 = $entero2;

            $val2 = ("0." . $decimal2) * 60;
            list($entero3, $decimal3) = explode(".", $val2);
            $datolatitude3 = $entero3;

            $latitudegr = ($datolatitude1 . "º" . $datolatitude2 . "'" . $datolatitude3 . "''N");
            /*ENDLatitude*/


            /*Longitude*/

            $longitudecrudo = $request->longitude;
            $longitude = substr($longitudecrudo, 1);


            list($enteroLon1, $decimalLon1) = explode(".", $longitude);
            $datolongitude1 = $enteroLon1;

            $valLon = ("0." . $decimalLon1) * 60;
            list($enteroLon2, $decimalLon2) = explode(".", $valLon);
            $datolongitude2 = $enteroLon2;

            $valLon2 = ("0." . $decimalLon2) * 60;
            list($enteroLon3, $decimalLon3) = explode(".", $valLon2);
            $datolongitude3 = $enteroLon3;

            $longitudegr = ($datolongitude1 . "º" . $datolongitude2 . "'" . $datolongitude3 . "''W");
            /*ENDLongitude*/

            $coordinates = ($latitudegr . " " . $longitudegr);

            /****************IDENT*******************/
            $lastpremise = Premise::latest('id')->first();
            if (isset($lastpremise->id)) {
                $lastpremiseint = (int) $lastpremise->id;
                $lastpremisemore = $lastpremiseint + 1;
            } else {
                $lastpremisemore = 1;
            }


            $departmentrequest = $request->department;
            $department = Department::where("id", $departmentrequest)
                ->first();
            $departmentname = $department->name;
            $department3 = substr($departmentname, 0, 3);
            $ident = $department3 . "-L" . $lastpremisemore;

            /*****************************************/


            /*****************************************/
            $premise = new Premise;
            $premise->idc = $request->idc;
            $premise->ident = $ident;
            $premise->rut = $request->rut;
            $premise->patent = $request->patent;
            $premise->address = $request->address;
            $premise->email = $request->email;
            $premise->name = $request->name;
            $premise->coordinates = $coordinates;
            $premise->latitude = $request->latitude;
            $premise->longitude = $request->longitude;
            $premise->department = $request->department;
            $premise->city = $request->city;
            $premise->neighborhood = $request->neighborhood;
            $premise->save();
            /*****************************************/

            /*LOGBOOK */
            $detailconstruction = "Data= Ident: " . $ident . "Responsible: " . $request->idc;
            $logbook = new Logbook;
            $logbook->email_user = auth()->user()->email;
            $logbook->activity = "Registrer Premise";
            $logbook->detail = $detailconstruction;
            $logbook->date_activity = Carbon::now();
            $logbook->save();
            /*END LOGBOOK */


            /* $premise = Premise::create($request->all()); */

            /* return redirect()->route('premise.index')->with('store','OK'); */
            return redirect()->route('machine.createt', $premise)->with('store', 'OK');
        } else {
            if ($rutunique) {
                return back()->with('rutunique', 'OK');
            } else {
                return back()->with('patentduplicate', 'OK');
            }
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Premise $premise)
    {
        //
        return view('premise.show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Premise $premise)
    {
        //
        return view('premise.edit', compact('premise'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Premise $premise)
    {
        //
        $request->validate([
                'idc' => 'required|min:6|max:15',
                'ident' => 'required|min:6|max:15',
                'rut' => 'required|min:6|max:15',
                'patent' => 'required|min:6|max:15',
                'address' => 'required|min:3|max:100',
                'email' => 'min:3|max:50',
                'phone' => 'min:8|max:32'
            ]);
        $premise->update($request->all());

        /*LOGBOOK */
        $detailconstruction = "Data= Ident: " . $request->ident . "Responsible: " . $request->idc;
        $logbook = new Logbook;
        $logbook->email_user = auth()->user()->email;
        $logbook->activity = "Update Premise";
        $logbook->detail = $detailconstruction;
        $logbook->date_activity = Carbon::now();
        $logbook->save();
        /*END LOGBOOK */


        return redirect()->route('premise.index')->with('edit', 'OK');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Premise $premise)
    {
        //
        $premise->delete();

        /*LOGBOOK */
        $detailconstruction = "Data= Ident: " . $premise->ident . "Responsible: " . $premise->idc;
        $logbook = new Logbook;
        $logbook->email_user = auth()->user()->email;
        $logbook->activity = "Delete Premise";
        $logbook->detail = $detailconstruction;
        $logbook->date_activity = Carbon::now();
        $logbook->save();
        /*END LOGBOOK */

        return redirect()->route('premise.index')->with('delete', 'OK');
    }

    public function createqr(Premise $premise)
    {
        //
        return view('premise.createqr', compact('premise'));
    }

    public function auditprub()
    {
        return redirect()->route('premise.auditview', 1);
        /* return view('premise.auditview', compact('premise')); */
    }

    public function auditindex()
    {
        $mailuser = auth()->user()->email;
        $prosecutor = Prosecutor::where("email", $mailuser)
            ->first();

        if (isset($prosecutor)) {
            $idc_prosecutor =  $prosecutor->idc;
            $auditpremises = Auditpremise::where("idc_prosecutor", $idc_prosecutor)
                ->get();
        } else {
            $auditpremises = Auditpremise::all();
        }


        return view('premise.auditindex', compact('auditpremises'));
    }


    public function auditview(Premise $premise)
    {
        $premise = Premise::where("id", $premise->id)
            ->first();
        $responsible = Responsible::where("idc", $premise->idc)
            ->first();
        $machines = Machine::where('premise_ident', $premise->ident)
            ->get();
        $countmachines = count($machines);
        return view('premise.audit', compact('premise', 'responsible', 'machines', 'countmachines'));
    }

    public function auditeject(Request $request)
    {

        $mailprosecutor = auth()->user()->email;
        $prosecutor = Prosecutor::where("email", $mailprosecutor)
            ->first();
        $premise = Premise::where("ident", $request->ident)
            ->first();


        /*Latitude*/
        $latitude = $request->latitude;

        list($entero1, $decimal1) = explode(".", $latitude);
        $datolatitude1 = $entero1;

        $val = ("0." . $decimal1) * 60;
        list($entero2, $decimal2) = explode(".", $val);
        $datolatitude2 = $entero2;

        $val2 = ("0." . $decimal2) * 60;
        list($entero3, $decimal3) = explode(".", $val2);
        $datolatitude3 = $entero3;

        $latitudegr = ($datolatitude1 . "º" . $datolatitude2 . "'" . $datolatitude3 . "''N");
        /*ENDLatitude*/


        /*Longitude*/

        $longitudecrudo = $request->longitude;
        $longitude = substr($longitudecrudo, 1);


        list($enteroLon1, $decimalLon1) = explode(".", $longitude);
        $datolongitude1 = $enteroLon1;

        $valLon = ("0." . $decimalLon1) * 60;
        list($enteroLon2, $decimalLon2) = explode(".", $valLon);
        $datolongitude2 = $enteroLon2;

        $valLon2 = ("0." . $decimalLon2) * 60;
        list($enteroLon3, $decimalLon3) = explode(".", $valLon2);
        $datolongitude3 = $enteroLon3;

        $longitudegr = ($datolongitude1 . "º" . $datolongitude2 . "'" . $datolongitude3 . "''W");
        /*ENDLongitude*/

        $coordinatesprosecutor = ($latitudegr . " " . $longitudegr);
        $coordinatespremise = $premise->coordinates;

        if ($coordinatesprosecutor == $coordinatespremise) {
            $auditpremise = new Auditpremise;
            $auditpremise->ident = $request->ident;
            $auditpremise->idc_responsible = $request->idc_responsible;
            $auditpremise->idc_prosecutor = $prosecutor->idc;
            $auditpremise->audit_date = Carbon::now()->format('Y-m-d');
            $auditpremise->note = $request->note;
            $auditpremise->save();

            /*LOGBOOK */
            $detailconstruction = "Data= Ident: " . $request->ident . "Responsible: " . $request->idc_responsible;
            $logbook = new Logbook;
            $logbook->email_user = auth()->user()->email;
            $logbook->activity = "Audit Premise";
            $logbook->detail = $detailconstruction;
            $logbook->date_activity = Carbon::now();
            $logbook->save();
            /*END LOGBOOK */

            return redirect()->route('premise.auditindex')->with('auditeject', 'OK');
        } else {

            /*LOGBOOK */
            $detailconstruction = "Data= Ident: " . $request->ident . "Responsible: " . $request->idc_responsible;
            $logbook = new Logbook;
            $logbook->email_user = auth()->user()->email;
            $logbook->activity = "Audit Premise ERROR";
            $logbook->detail = $detailconstruction;
            $logbook->date_activity = Carbon::now();
            $logbook->save();
            /*END LOGBOOK */

            return redirect()->route('premise.auditindex')->with('auditeject', 'NOT');
        }
    }

    public function prubip()
    {
        $ip = request()->ip();
        dd($ip);
    }



    public function map()
    {
        $initialMarkers = [
            [
                'position' => [
                    'lat' => 10.0990976,
                    'lng' => -69.3108736
                ],
                'draggable' => true
            ],

        ];
        return view('premise.map', compact('initialMarkers'));
    }

    public function indexpdfprem()
    {
        $premises = Premise::all();

        $pdf = Pdf::loadView('premise.indexpdf', compact('premises'))->setPaper('a4', 'portrait');
        return $pdf->stream('premisesreport.pdf');
    }
}
