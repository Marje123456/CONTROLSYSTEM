<?php

namespace App\Http\Controllers;

use App\Models\Logbook;
use App\Models\User;
use App\Models\Role;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Contracts\Role as ContractsRole;
use Spatie\Permission\Models\Role as ModelsRole;
use Spatie\Permission\Models\Permission;

class UseroController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:gestionar_usuarios')->only('index');
        $this->middleware('can:gestionar_usuarios')->only('create');
        $this->middleware('can:gestionar_usuarios')->only('store');
        $this->middleware('can:gestionar_usuarios')->only('edit');
        $this->middleware('can:gestionar_usuarios')->only('update');
        $this->middleware('can:gestionar_usuarios')->only('destroy');
        $this->middleware('can:gestionar_usuarios')->only('asign');
    }

    public function index()
    {
        //

       /*  $relacionEloquent = 'roles'; 
        $useros = User::whereHas($relacionEloquent, function ($query) 
        { 
            return $query->where('name', '!=', 'Administrador'); 
        })->get(); */


        $useros = User::all();

        return view('usero.index',compact('useros'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        
        $roles = ModelsRole::all();
        return view('usero.create', compact( 'roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $userounique = User::where("email", $request->email)->first();   
        if (!$userounique) 
        {
            $imagen = $request->file("imagen");
        
        $request->validate([
            'imagen' => 'required|mimes:jpeg,jpg,png|max:5120',
        ]);

        // Especificar explícitamente el disco 'public'
        $disk = 'public';
        
        // Crear directorio si no existe
        $directory = 'images/users';
        if (!Storage::disk($disk)->exists($directory)) {
            Storage::disk($disk)->makeDirectory($directory, 0755, true);
        }

        // Guardar la imagen en el disco público
        $filename = time() . '_' . $imagen->getClientOriginalName();
        $path = $imagen->storeAs($directory, $filename, $disk);
        
        // Obtener la URL pública
        $url = Storage::disk($disk)->url($path);

        //
        $usero= new User;
        $usero->name = $request->name;
        $usero->email = $request->email;
        $usero->password = $request->pass;
        $usero->avatar = $url;
        $usero->save();

        /*LOGBOOK */
        $detailconstruction = "Data= Name: ".$request->name."| Email: ".$request->email."| Password: ".$request->pass;
        $logbook= new Logbook;
        $logbook->email_user = auth()->user()->email;
        $logbook->activity = "Register User";
        $logbook->detail = $detailconstruction;
        $logbook->date_activity = Carbon::now();
        $logbook->save();
        /*END LOGBOOK */

        return redirect()->route('usero.index')->with('store','OK');
        }  
        else
        {
            return back()->with('emailduplicate','OK');
        }

        


        /* $usero = User::create($request->all()); */
        
    }

    /**
     * Display the specified resource.
     */
    public function show(User $usero)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usero)
    {
        //
        $usero = User::find($usero->id);
        $roles = ModelsRole::all();
        return view('usero.userorole',compact('usero','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usero)
    {
        //
        $usero = User::find($usero->id);
        
        $usero->roles()->sync($request->roles);

        /*LOGBOOK */
        $detailconstruction = "Data= Name: ".$usero->name."| Email: ".$usero->email;
        $logbook= new Logbook;
        $logbook->email_user = auth()->user()->email;
        $logbook->activity = "Update Role";
        $logbook->detail = $detailconstruction;
        $logbook->date_activity = Carbon::now();
        $logbook->save();
        /*END LOGBOOK */

        return redirect()->route('usero.index')->with('edit','OK');
        /* return redirect()->route('usero.asign', 'usero'); */
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usero)
    {
        //
        $usero->delete();

        /*LOGBOOK */
        $detailconstruction = "Data= Name: ".$usero->name."| Email: ".$usero->email;
        $logbook= new Logbook;
        $logbook->email_user = auth()->user()->email;
        $logbook->activity = "Delete User";
        $logbook->detail = $detailconstruction;
        $logbook->date_activity = Carbon::now();
        $logbook->save();
        /*END LOGBOOK */

        return redirect()->route('usero.index')->with('delete','OK');
    }

    /* este es asignar.edit */
    public function asign(User $usero)
    {
        $usero = User::find($usero->id);
        $roles = ModelsRole::all();
        return view('usero.userorole',compact('usero','roles'));
    }
}
