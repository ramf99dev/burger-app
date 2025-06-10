<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Hash;

class UsuarioAdminController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::query()->orderBy('id', 'desc');

        if (request()->has('buscar')) {
            $usuarios = $usuarios->where('name', 'like', request()->get('buscar', '') . '%');
        }

        $usuarios = $usuarios->simplePaginate(8);

        return view('usuario.index', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('usuario.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', Rules\Password::defaults()],
            'telefono' => ['required', 'string'],
        ]);

        $usuario = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'telefono' => $request->telefono,
            'permiso' => 1,
        ]);

        return to_route('usuario.index', $usuario);
    }

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
        return view('usuario.edit', ['usuario' => $usuario]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $usuario)
    {
        if ($request->email === $usuario->email) {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'password' => ['required', Rules\Password::defaults()],
                'telefono' => ['required', 'string'],
            ]);

            $usuario->update([
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'telefono' => $request->telefono,
            ]);

        } else {
            $data = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
                'password' => ['required', Rules\Password::defaults()],
                'telefono' => ['required', 'string'],
            ]);

            $usuario->update([
                'name' => $request->name,
                'email' => $request->email,
                'password' => Hash::make($request->password),
                'telefono' => $request->telefono,
            ]);
        }




        return to_route('usuario.index', $usuario);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $usuario)
    {
        $usuario->delete();

        return to_route('usuario.index');
    }
}
