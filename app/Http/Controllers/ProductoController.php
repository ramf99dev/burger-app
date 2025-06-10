<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $productos = Producto::query()->orderBy('id', 'desc');

        if (request()->has('buscar')) {
            $productos = $productos->where('nombre', 'like', request()->get('buscar', '') . '%');
        }

        $productos = $productos->simplePaginate(8);

        return view('producto.index', ['productos' => $productos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categorias = Categoria::query()->orderBy('id', 'desc')->simplePaginate(100);
        return view('producto.create', ['categorias' => $categorias]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nombre' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
            'categoria_id' => ['required', 'integer'],
            'precio' => ['required', 'decimal:0,5'],
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            $imageName = 'product_' . $request->id . '_' . time() . '.' . $request->imagen->extension();

            $request->imagen->move(public_path('images/uploads/'), $imageName);

            $imagePath = 'images/uploads/' . $imageName;

            $producto = Producto::create([
                'nombre' => $validatedData['nombre'],
                'descripcion' => $validatedData['descripcion'],
                'categoria_id' => $validatedData['categoria_id'],
                'precio' => $validatedData['precio'],
                'imagen' => $imagePath
            ]);
        }

        return redirect()->route('producto.index');
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
    public function edit(Producto $producto)
    {
        $categorias = Categoria::query()->orderBy('id', 'desc')->simplePaginate(100);
        return view('producto.edit', ['producto' => $producto, 'categorias' => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Producto $producto)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'nombre' => ['required', 'string'],
            'descripcion' => ['required', 'string'],
            'categoria_id' => ['required', 'integer'],
            'precio' => ['required', 'decimal:0,5'],
            'imagen' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        if ($request->hasFile('imagen')) {
            if ($producto->imagen && file_exists(public_path($producto->imagen))) {
                unlink(public_path($producto->imagen));
            }

            $imageName = 'product_' . $producto->id . '_' . time() . '.' . $request->imagen->extension();

            $request->imagen->move(public_path('images/uploads/'), $imageName);

            $imagePath = 'images/uploads/' . $imageName;

            $producto->update([
                'nombre' => $validatedData['nombre'],
                'descripcion' => $validatedData['descripcion'],
                'categoria_id' => $validatedData['categoria_id'],
                'precio' => $validatedData['precio'],
                'imagen' => $imagePath
            ]);
        }

        return redirect()->route('producto.index');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Producto $producto)
    {
        $producto->delete();

        return to_route('producto.index');
    }
}
