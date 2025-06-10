<?php

namespace App\Http\Controllers;

use App\Models\Zona;
use Illuminate\Http\Request;

class ZonaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $zonas = Zona::query()->orderBy('id', 'desc');

        if (request()->has('buscar')) {
            $zonas = $zonas->where('nombre', 'like', request()->get('buscar', '') . '%');
        }

        $zonas = $zonas->simplePaginate(8);

        return view('zona.index', ['zonas' => $zonas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('zona.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string'],
            'numero_personas' => ['required', 'integer'],
            'costo' => ['required', 'decimal:0,4']
        ]);

        $zona = Zona::create($data);

        return to_route('zona.index', $zona);
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
    public function edit(Zona $zona)
    {
        return view('zona.edit', ['zona' => $zona]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Zona $zona)
    {
        $data = $request->validate([
            'nombre' => ['required', 'string'],
            'numero_personas' => ['required', 'integer'],
            'costo' => ['required', 'decimal:0,4']
        ]);


        $zona->update($data);

        return to_route('zona.index', $zona);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Zona $zona)
    {
        $zona->delete();

        return to_route('zona.index');
    }
}
