<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Product;
use App\Models\Consumption;
use Illuminate\Http\Request;

class ConsumptionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productId = $request->get('product_id');
        if ($productId) {
            $consumptions = Consumption::where('product_id', $productId)
                ->with('user')
                ->latest()
                ->paginate(10);
        } else {
            $consumptions = Consumption::with('user')
                ->latest()
                ->paginate(10);
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::pluck('id', 'id');
        $users = User::pluck('id', 'id');
        return view('consumptions.create', compact('products', 'users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'user_id' => 'required',
            'product_id' => 'required',
            'quantity' => 'required',
            'reason' => 'required',
        ]);

        $request->merge(['date_time' => now()]); 

        Consumption::create($request->all());
        return redirect()->route('consumptions.index')->with('success', 'Consum registrat correctament!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Consumption $consumption)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Consumption $consumption)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Consumption $consumption)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Consumption $consumption)
    {
        //
    }
}
