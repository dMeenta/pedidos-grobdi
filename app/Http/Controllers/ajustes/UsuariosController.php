<?php

namespace App\Http\Controllers\ajustes;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Zone;

class UsuariosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::with(['role', 'zones'])
            ->orderBy('name')
            ->paginate(25);

        return view('ajustes.usuarios.index', compact('usuarios'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(){
        $zonas = Zone::orderBy('id','desc')->get();
        $roles = Role::all();
        return view('ajustes.usuarios.create',compact('zonas','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
            'role_id' => 'required|exists:roles,id',
        ]);
        // dd($request->all());
        
        $user = User::create(attributes: [
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role_id' => $request->role_id,
        ]);
        $user->zones()->attach($request->zonas);

        return redirect()->route('usuarios.index');
    }
// dsada
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $usuario)
    {
        $zonas = Zone::orderBy('id','desc')->get();
        $roles = Role::all();

        // dd($usuario->zones()->pluck('zones.id'));
        return view('ajustes.usuarios.edit', compact('usuario', 'zonas','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    // Actualizar un usuario
    public function update(Request $request, User $usuario)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'zonas' => 'required|array|min:1', // Aseguramos que al menos una zona sea seleccionada
            'zonas.*' => 'exists:zones,id', // Validamos que las zonas existan
        ]);
        
        $usuario->update(attributes: [
            'name' => $request->name,
            'email' => $request->email,
            'role_id' => $request->role_id,
        ]);
        // Actualizamos las zonas asignadas
        $usuario->zones()->sync($request->zonas);
        
        return redirect()->route('usuarios.index');
    }
    public function changepass(Request $request, $usuario){
        $request->validate([
            'password' => 'required|string|min:8|confirmed',
            'password_confirmation' => 'required',
          ]);

        $user = User::find($usuario);
        $user->password = Hash::make($request->password);
        $user->save();
        return back()->with('success','Contraseña cambiada correctamente');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::find($id);
        if($user->active == 1){
            $user->active = 0;
            $msj = "inhabilitado";
        }else{
            $user->active = 1;
            $msj = "habilitado";
        }
        $user->save();
        return redirect()->route('usuarios.index')->with('success','usuario '.$msj.' correctamente');
    }
}
