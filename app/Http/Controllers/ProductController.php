<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Models\Cascode;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Get all products
        $allProducts = Product::all();

        // Initializing an array to store grouped products
        $groupedProducts = [];

        // Group the products by CAS/CONCENTRACIÓ
        foreach ($allProducts as $product) {
            // Group key
            $key = $product->cas_code . '-' . $product->concentration;

            // If the grouping key does not exist, initialize a new array
            if (!isset($groupedProducts[$key])) {
                $groupedProducts[$key] = [
                    'cas_code' => $product->cas_code,
                    'concentration' => $product->concentration,
                    'products' => [],
                ];
            }

            // Add the product to the corresponding group
            $groupedProducts[$key]['products'][] = $product;
        }

        $cascodes = Cascode::pluck('cas_code', 'cas_code');
        return view('products.index', compact('groupedProducts','cascodes', 'allProducts'));
    }

    public function filter(Request $request)
    {
        $query = Product::query();

        if ($request->has('cas_code')) {
            $query->where('cas_code', $request->cas_code);
        }

        if ($request->has('expiration_date')) {
            $query->whereDate('expiration_date', $request->expiration_date);
        }

        $filteredProducts = $query->get();

        $groupedProducts = [];

        foreach ($filteredProducts as $product) {
            $key = $product->cas_code . '-' . $product->concentration;

            if (!isset($groupedProducts[$key])) {
                $groupedProducts[$key] = [
                    'cas_code' => $product->cas_code,
                    'concentration' => $product->concentration,
                    'products' => [],
                ];
            }
            $groupedProducts[$key]['products'][] = $product;
        }

        $cascodes = Cascode::pluck('cas_code', 'cas_code');
        return view('products.filter', compact('groupedProducts', 'cascodes', 'filteredProducts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cascodes = Cascode::pluck('cas_code', 'cas_code');
        return view('products.create', compact('cascodes'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'concentration' => 'required',
            'concentration_type' => 'required',
            'capacity' => 'required',
            'expiration_date' => 'required',
            'locker' => 'required',
        ]);

        // Si se proporciona un nuevo cas_code, crea un registro en la tabla Cascode
        if ($request->filled('new_cas_code')) {
            $request->validate([
                'new_cas_code' => 'required|unique:cascodes,cas_code', // Verifica si el nuevo cas_code ya existe
                'name' => 'required',
                'fds' => 'required',
                'status' => 'required|in:S,L',
            ]);

            $newCascode = Cascode::create([
                'cas_code' => $request->new_cas_code,
                'name' => $request->name,
                'fds' => $request->fds,
                'status' => $request->status,
            ]);

            $cas_code = $newCascode->cas_code; // Obtiene el cas_code creado
        } else {
            $cas_code = $request->cas_code; // Utiliza el cas_code existente si se proporciona uno
        }

        // Crea el producto
        Product::create([
            'cas_code' => $cas_code,
            'concentration' => $request->concentration,
            'concentration_type' => $request->concentration_type,
            'capacity' => $request->capacity,
            'expiration_date' => $request->expiration_date,
            'locker' => $request->locker,
        ]);

        return redirect()->route('products.index')->with('success', 'Producte afegit correctament!');
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $cascodes = Cascode::pluck('cas_code', 'cas_code');
        return view('products.edit', ['product' => $product], compact('cascodes'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'cas_code' => 'required_without:new_cas_code', // Required if no new cas_code is provided
            'new_cas_code' => 'required_without:cas_code', // Required if no existing cas_code is provided
            'concentration' => 'required',
            'concentration_type' => 'required',
            'capacity' => 'required',
            'expiration_date' => 'required',
            'locker' => 'required',
        ]);

        // Checks if a new cas_code is provided and creates it if so
        if ($request->filled('new_cas_code')) {
            Cascode::create(['cas_code' => $request->new_cas_code]);
            $cas_code = $request->new_cas_code;
        } else {
            $cas_code = $request->cas_code;
        }

        // Update the product
        $product->update([
            'cas_code' => $cas_code,
            'concentration' => $request->concentration,
            'concentration_type' => $request->concentration_type,
            'capacity' => $request->capacity,
            'expiration_date' => $request->expiration_date,
            'locker' => $request->locker,
        ]);

        return redirect()->route('products.index')->with('success', 'Producte actualitzat correctament!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return redirect()->route('products.index')->with('success', 'Producte eliminat correctament!');
    }
}
