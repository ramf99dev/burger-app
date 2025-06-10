<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categorias = Categoria::query()->orderBy('id', 'desc');

        if (request()->has('buscar')) {
            $categorias = $categorias->where('nombre', 'like', request()->get('buscar', '') . '%');
        }

        $categorias = $categorias->simplePaginate(8);

        return view('categoria.index', ['categorias' => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categoria.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string'],
        ]);

        $categoria = Categoria::create($data);

        return to_route('categoria.index', $categoria);
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
    public function edit(Categoria $categoria)
    {
        return view('categoria.edit', ['categoria' => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categoria $categoria)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string'],
        ]);


        $categoria->update($data);

        return to_route('categoria.index', $categoria);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categoria $categoria)
    {
        $categoria->delete();

        return to_route('categoria.index');
    }
}
