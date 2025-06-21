<?php

namespace App\Http\Controllers;

use App\Models\Itinerary;
use App\Models\ItineraryProsecutor;
use App\Models\Premise;
use App\Models\Prosecutor;
use App\Models\User;
use Illuminate\Http\Request;

class ProsecutorController extends Controller
{

    public function __construct()
    {
        $this->middleware('can:gestionar_fiscales')->only('index');
        $this->middleware('can:gestionar_fiscales')->only('create');
        $this->middleware('can:gestionar_fiscales')->only('store');
        $this->middleware('can:gestionar_fiscales')->only('show');
        $this->middleware('can:gestionar_fiscales')->only('edit');
        $this->middleware('can:gestionar_fiscales')->only('update');
        $this->middleware('can:gestionar_fiscales')->only('destroy');
    }

    /**
     * Display a listing of the resource. Mostrar un listado del recurso. Leer todos los registros / Mostrar
     */
    public function index()
    {
        //
        $prosecutors = Prosecutor::all();
        return view('prosecutor.index',compact('prosecutors'));
    }

    /**
     * Show the form for creating a new resource. Muestra el formulario para crear un nuevo recurso. Formulario para nuevo registro
     */
    public function create()
    {
        //

        return view('prosecutor.create');
    }

    /**
     * Store a newly created resource in storage. Almacena un recurso recién creado en el almacén. Guardar en sb el nuevo registro
     */
    public function store(Request $request)
    {
        //
        $idcunique = Prosecutor::where("idc", $request->idc)->first();
        $emailunique = Prosecutor::where("email", $request->email)->first();

        if (!$idcunique && !$emailunique) {
            $request->validate
            ([
                'idc' => 'required|min:6|max:15',
                'names' => 'required|min:3|max:50',
                'last_names' => 'required|min:3|max:50',
                'phone' => 'min:8|max:32',
                'email' => 'min:5|max:50'
            ]);
            /* return $request->all(); */
    
            $usero = new User;
            $usero->name = $request->names;
            $usero->email = $request->email;
            $usero->password = $request->idc;
            $usero->save();
    
            $prosecutor = Prosecutor::create($request->all());
            return redirect()->route('prosecutor.index')->with('store','OK');
        } else {
            if ($idcunique) {
                return back()->withInput()->with('idcduplicate','OK');
            } else {
                return back()->with('emailduplicate','OK');
            }
        }
        
       
    }

    /**
     * Display the specified resource. Muestra el recurso especificado. Visualizar un registro especifico
     */
    public function show(Prosecutor $prosecutor)
    {
        //
        return view('prosecutor.show');
    }

    /**
     * Show the form for editing the specified resource. Mostrar el formulario para editar el recurso especificado. 
     */
    public function edit(Prosecutor $prosecutor)
    {
        //
        return view('prosecutor.edit', compact('prosecutor'));
    }

    /**
     * Update the specified resource in storage. Actualiza el recurso especificado en el almacenamiento.
     */
    public function update(Request $request, Prosecutor $prosecutor)
    {
        //
        $request->validate
        ([
            'idc' => 'required|min:6|max:15',
            'names' => 'required|min:3|max:50',
            'last_names' => 'required|min:3|max:50',
            'phone' => 'min:8|max:20',
            'email' => 'min:5|max:50'
        ]);

        $prosecutor->update($request->all());
        return redirect()->route('prosecutor.index')->with('edit','OK');
    }

    /**
     * Remove the specified resource from storage. Elimina el recurso especificado del almacenamiento.
     */
    public function destroy(Prosecutor $prosecutor)
    {
        //
        $prosecutor->delete();
        return redirect()->route('prosecutor.index')->with('delete','OK');
    }

    public function myitinerary()
    {
        $mailuser = auth()->user()->email;
        $prosecutor = Prosecutor::where("email", $mailuser)
                            ->first();
        $itineraries = Itinerary::where("idc_prosecutor", $prosecutor->idc)
                            ->first();  
    
    $premiselist = Premise::where("neighborhood", $itineraries->neighborhood)
                            ->get();      
    return view('prosecutor.viewitinerary', compact('prosecutor', 'itineraries', 'premiselist'));
    }

    public function viewitinerary(Prosecutor $prosecutor)
    {
        $itineraries = Itinerary::where("idc_prosecutor", $prosecutor->idc)
                                ->first();  
        
        $premiselist = Premise::where("neighborhood", $itineraries->neighborhood)
                                ->get();      
        return view('prosecutor.viewitinerary', compact('prosecutor', 'itineraries', 'premiselist'));
    }
}
