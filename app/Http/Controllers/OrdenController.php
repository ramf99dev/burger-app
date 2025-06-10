<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Orden;
use App\Models\OrdenProducto;
use App\Models\Producto;
use App\Models\Reserva;
use DB;
use Illuminate\Http\Request;

class OrdenController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $ordenes = Orden::with(['user', 'productos'])
            ->oldest()
            ->paginate(10);

        return view('orden.index', compact('ordenes'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        if (auth()->user()->permiso == 2 && !$request->has('reserva_id')) {
            abort(403, 'Acceso denegado.');
        }

        $reserva = null;
        if ($request->has('reserva_id')) {
            $reserva = Reserva::findOrFail($request->reserva_id);

            if (auth()->user()->permiso == 2 && $reserva->user_id != auth()->id()) {
                abort(403, 'Reservacion Invalida.');
            }
        }

        $categorias = Categoria::with('productos')->get();
        return view('orden.create', compact('categorias', 'reserva'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:0',
            'productos.*.precio' => 'required|numeric|min:0',
            'reserva_id' => 'sometimes|exists:reservas,id'
        ]);

        $productos = array_filter($request->productos, function ($producto) {
            return $producto['cantidad'] > 0;
        });

        if (empty($productos)) {
            return back()->with('error', 'Debe seleccionar al menos un producto con cantidad mayor a 0');
        }

        DB::beginTransaction();

        try {
            $orden = Orden::create([
                'user_id' => auth()->id(),
                'total' => 0,
                'estado' => 'pendiente'
            ]);

            $total = 0;
            $productosData = [];

            foreach ($productos as $producto) {
                $subtotal = $producto['precio'] * $producto['cantidad'];
                $total += $subtotal;

                $productosData[$producto['id']] = [
                    'cantidad' => $producto['cantidad'],
                    'precio_producto' => $producto['precio'],
                    'subtotal' => $subtotal
                ];
            }

            $orden->productos()->attach($productosData);

            $orden->update(['total' => $total]);

            if ($request->has('reserva_id')) {
                $reserva = Reserva::find($request->reserva_id);
                $reserva->update(['orden_id' => $orden->id]);
            }


            DB::commit();

            if ($request->has('reserva_id')) {
                return redirect()->route('reserva.show', ['reserva' => $request->reserva_id])
                    ->with('success', 'Orden creada exitosamente!');
            }

            return redirect()->route('orden.index')
                ->with('success', 'Orden creada exitosamente!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al crear la orden: ' . $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Orden $orden)
    {
        $orden->load('ordenProductos.producto');

        return view('orden.show', compact('orden'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Orden $orden)
    {
        $categorias = Categoria::with('productos')->get();
        return view('orden.edit', compact('orden', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Orden $orden)
    {
        $validated = $request->validate([
            'productos' => 'required|array',
            'productos.*.id' => 'required|exists:productos,id',
            'productos.*.cantidad' => 'required|integer|min:0',
            'productos.*.precio' => 'required|numeric|min:0'
        ]);

        DB::beginTransaction();
        try {
            $orden->productos()->detach();

            $total = 0;
            $productosData = [];

            foreach ($request->productos as $producto) {
                if ($producto['cantidad'] > 0) {
                    $subtotal = $producto['cantidad'] * $producto['precio'];
                    $total += $subtotal;

                    $productosData[$producto['id']] = [
                        'cantidad' => $producto['cantidad'],
                        'precio_producto' => $producto['precio'],
                        'subtotal' => $subtotal
                    ];
                }
            }

            $orden->productos()->attach($productosData);
            $orden->update(['total' => $total, 'estado' => $request->estado]);

            DB::commit();
            return redirect()->route('orden.index')
                ->with('success', 'Orden actualizada exitosamente!');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Error al actualizar la orden: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Orden $orden)
    {
        $orden->delete();

        return to_route('orden.index');
    }
}
