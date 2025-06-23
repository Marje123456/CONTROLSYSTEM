<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Department;
use App\Models\ItineraryProsecutor;
use App\Models\Itinerary;
use App\Models\Neighborhood;
use App\Models\Premise;
use App\Models\Prosecutor;
use Illuminate\Http\Request;

class ItineraryController extends Controller
{

    public function __construct()
    {
        /* $this->middleware('can:crear_ruta')->only('create');
        $this->middleware('can:crear_ruta')->only('store');
        $this->middleware('can:asignar_ruta')->only('asignitinerary');
        $this->middleware('can:asignar_ruta')->only('asignitineraryr'); */
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $itineraries = Itinerary::all();
        $prosecutors = Prosecutor::all();
        $departments = Department::all();
        $cities = City::all();
        $neighborhoods = Neighborhood::all();
        return view('itinerary.index',compact('itineraries','prosecutors','departments','cities','neighborhoods'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $prosecutors = [];
        $prosecutorsRESULT = Prosecutor::all();
        foreach ($prosecutorsRESULT as $prosecutor) 
        {
            $itineraries = Itinerary::where(
                "idc_prosecutor", $prosecutor->idc
            )->first();
            if (!isset($itineraries->idc_prosecutor)) 
            {
                $newprosec = array(
                    'idc' => $prosecutor->idc, 
                    'names' => $prosecutor->names, 
                    'last_names' => $prosecutor->last_names
            );
            array_push($prosecutors, $newprosec);
            }
        } 

       
        return view('itinerary.create',compact('prosecutors'));
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        /****************ID_ITINERARY*******************/
        $lastitinerary = Itinerary::latest('id')->first();
        if (isset($lastitinerary->id)) 
            {
                $lastitineraryint = (int) $lastitinerary->id;
                $lastitinerarymore = $lastitineraryint+1;
            } else 
            {
                $lastitinerarymore = 1;
            }

        $departmentrequest = $request->department;
        $department = Department::where("id", $departmentrequest)->first();
        $departmentname = $department->name;
        $department3 = substr($departmentname, 0, 2);

        $cityrequest = $request->city;
        $city = City::where("id", $cityrequest)->first();
        $cityname = $city->name;
        $city3 = substr($cityname, 0, 2);

        $neighborhoodrequest = $request->neighborhood;
        $neighborhood = Neighborhood::where("id", $neighborhoodrequest)->first();
        $neighborhoodname = $neighborhood->name;
        $neighborhood3 = substr($neighborhoodname, 0, 2);


        $id_itinerary = $department3."".$city3."".$neighborhood3."-0".$lastitinerarymore;
            
        /*****************************************/
        
        $itinerary= new Itinerary;
        $itinerary->id_itinerary = $id_itinerary;
        $itinerary->name = $request->name_itinerary;
        $itinerary->idc_prosecutor = $request->selectprosecutor;
        $itinerary->department = $request->department;
        $itinerary->city = $request->city;
        $itinerary->neighborhood = $request->neighborhood;
        $itinerary->ident_premise = 0;
        $itinerary->save();


        /* $chekes = $request->checkpremise; */
       
       /*  foreach ($chekes as $premise) 
        {
            $itinerary= new Itinerary;
            $itinerary->id_itinerary = $request->id_itinerary;
            $itinerary->name = $request->name_itinerary;
            
            $itinerary->save();
        } */
        return redirect()->route('itinerary.create')->with('storeitinerary','OK');
        /* return view('itinerary.create',compact('premises'))->with('storeitinerary','OK'); */
       
    }

    /**
     * Display the specified resource.
     */
    public function show(Itinerary $itinerary)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Itinerary $itinerary)
    {
        //
        //$prosecutors = Prosecutor::all();

        $prosecutore = Prosecutor::where("idc", $itinerary->idc_prosecutor)->first();

        $department = Department::where("id", $itinerary->department)->first();
        $city = City::where("id", $itinerary->city)->first();
        $neighborhood = Neighborhood::where("id", $itinerary->neighborhood)->first();

        $prosecutors = [];
        $prosecutorsRESULT = Prosecutor::all();
        foreach ($prosecutorsRESULT as $prosecutor) 
        {
            $itineraries = Itinerary::where(
                "idc_prosecutor", $prosecutor->idc
            )->first();
            if (!isset($itineraries->idc_prosecutor)) 
            {
                $newprosec = array(
                    'idc' => $prosecutor->idc, 
                    'names' => $prosecutor->names, 
                    'last_names' => $prosecutor->last_names
            );
            array_push($prosecutors, $newprosec);
            }
        } 

        return view('itinerary.edit', compact('itinerary','prosecutors','department','city','neighborhood', 'prosecutore'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Itinerary $itinerary)
    {
        //
        $itinerary = Itinerary::where("id_itinerary", $request->id_itinerary)
                            ->first();
                        
        $itinerary->idc_prosecutor = $request->selectprosecutor;
        $itinerary->save();
                        
                        
        //$itinerary->update($request->all());
        return redirect()->route('itinerary.index')->with('edititinerary','OK');
        /* return redirect()->itinerary('itinerary.edit', $itinerary); */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Itinerary $itinerary)
    {
        //
        $itinerary->delete();
        return redirect()->route('itinerary.index')->with('delete','OK');
    }

    public function asignitinerary()
    {
        $itineraries = Itinerary::distinct('id_itinerary')->get();
        $prosecutors = Prosecutor::all();
        return view('itinerary.asignitiprosec',compact('itineraries','prosecutors'));
    }

    public function asignitineraryr(Request $request)
    {
        //
        
            $itineraryp= new ItineraryProsecutor;
            
            $itineraryp->id_itinerary = $request->selectitinerary;
            $itineraryp->idc_prosecutor = $request->selectprosecutor;
            
            $itineraryp->save();
       

            $itineraries = Itinerary::all();
            $prosecutors = Prosecutor::all();
            return redirect()->route('itinerary.asignitinerary')->with('asigiti','OK');
            /* return view('itinerary.asignitiprosec',compact('itineraries','prosecutors')); */
       
    }


    public function map(Itinerary $itinerary)
    {
        $itineraries = Itinerary::where("id", $itinerary->id)->first();
       
        $premisemarkers = Premise::where("neighborhood", $itinerary->neighborhood)->get();

        $initialMarkers = [];

        foreach ($premisemarkers as $premisemarker) 
        {
            $latpremise = $premisemarker->latitude;
            $lonpremise = $premisemarker->longitude;
            $nuevo_Markers = array('position' => ['lat' => $latpremise,'lng' => $lonpremise], 'draggable' => true);
            array_push($initialMarkers, $nuevo_Markers);
        }

        return view('itinerary.map', compact('initialMarkers','itineraries'));
    }


    /* public function map(Itinerary $itinerary)
    {
        $itineraries = Itinerary::where("id", $itinerary->id)->first();
       
        $premisemarkers = Premise::where("neighborhood", $itinerary->neighborhood)->first();

        $latpremise = $premisemarkers->latitude;
        $lonpremise = $premisemarkers->longitude;
        
        $initialMarkers = [];
        
        $nuevo_Markers = array('position' => ['lat' => $latpremise,'lng' => $lonpremise], 'draggable' => true);
        array_push($initialMarkers, $nuevo_Markers);

        $nuevo_Markers = array('position' => ['lat' => -20.209428981242677,'lng' => -61.81841673317628], 'draggable' => true);
        array_push($initialMarkers, $nuevo_Markers);

        return view('itinerary.map', compact('initialMarkers'));
    } */

    
}
