<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Reserva;
use App\Models\Zona;
use Carbon\Carbon;
use DB;
use Illuminate\Http\Request;

class ReservaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (auth()->user()->permiso == 0 || auth()->user()->permiso == 1) {
            $reservas = Reserva::with(['user', 'orden', 'zona'])
                ->oldest()
                ->paginate(10);
        } else {
            $reservas = Reserva::where('user_id', auth()->id())->oldest()->paginate(10);
        }

        return view('reserva.index', compact('reservas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $zonas = Zona::query()->orderBy('id', 'desc')->simplePaginate(100);
        return view('reserva.create', ['zonas' => $zonas]);
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
            $reserva = Reserva::create([
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
                return redirect()->route('orden.create', ['reserva_id' => $reserva->id]);
            }

            DB::commit();
            return redirect()->route('reserva.show', ['reserva' => $reserva->id]);
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear la reserva: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Reserva $reserva)
    {
        $reserva->load(['user', 'orden', 'zona']);

        return view('reserva.show', compact('reserva'));
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
    public function destroy(Reserva $reserva)
    {
        DB::transaction(function () use ($reserva) {
            if ($reserva->orden) {
                $reserva->orden->delete();
            }

            $reserva->delete();
        });

        return redirect()->route('reserva.index');
    }
}
