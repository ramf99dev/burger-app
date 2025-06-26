<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Domicilio;
use App\Models\Zona;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class DomicilioController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->permiso == 0 || auth()->user()->permiso == 1) {
            $domicilio = Domicilio::with(['user', 'orden', 'zona'])
                ->oldest()
                ->paginate(10);
        } else {
            $domicilio = Domicilio::where('user_id', auth()->id())->oldest()->paginate(10);
        }

        return view('domicilio.index', compact('domicilio'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zonas = Zona::query()->orderBy('id', 'desc')->simplePaginate(100);
        return view('domicilio.create', ['zonas' => $zonas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string',
            'fecha' => 'required|date|after_or_equal:today',
            'hora' => 'required|date_format:H:i',
            'numero_personas' => 'required|numeric|min:1',
            'zona_id' => 'required|exists:zonas,id',
            'orden' => 'sometimes|boolean'
        ]);

        DB::beginTransaction();
        try {
            $domicilio = Domicilio::create([
                'nombre' => $request->nombre,
                'numero_personas' => $request->numero_personas,
                'fecha' => Carbon::parse($request->fecha),
                'hora' => Carbon::parse($request->hora),
                'zona_id' => $request->zona_id,
                'user_id' => auth()->id(),
                'orden_id' => null
            ]);

            if ($request->has('orden') && $request->orden) {
                DB::commit();
                return redirect()->route('orden.create', ['domicilio_id' => $domicilio->id]);
            }

            DB::commit();
            return redirect()->route('domicilio.show', ['domicilio' => $domicilio->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear el pedido: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Domicilio $domicilio)
    {
        $domicilio->load(['user', 'orden', 'zona']);

        return view('domicilio.show', compact('domicilio'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Domicilio $domicilio)
    {
        DB::transaction(function () use ($domicilio) {
            if ($domicilio->orden) {
                $domicilio->orden->delete();
            }

            $domicilio->delete();
        });

        return redirect()->route('domicilio.index');
    }
}
