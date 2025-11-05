<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('viewAny', Purchase::class);

        $user = auth()->user();
        $purchaseQuery = Purchase::with(['customer', 'product'])->latest();

        if($user->role === 'employee') {
            $purchaseQuery = Purchase::whereHas('customer', function ($query) use ($user) {
                $query->where('user_id', $user->id);
            });
        }

        return view('purchase.index', [
            'purchases' => $purchaseQuery->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Purchase::class);

        $user = auth()->user();
        $customerQuery = Customer::latest()->get();

        if($user->role === 'employee') {
            $customerQuery = Customer::where('user_id', $user->id)->get();
        } 

        return view('purchase.create', [
            'customers' => $customerQuery->get(),
            'products' => Product::latest()->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Purchase::class);

        $data = $request->validate([
            'product_id' => 'required',
            'customer_id' => 'required',
            'quantity' => 'required'
        ]);

        Purchase::create($data);

        return redirect()->route('purchases.index')->with('success', 'Congrats, Purchase Successfull');
    }

    /**
     * Display the specified resource.
     */
    public function show(Purchase $purchase)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Purchase $purchase)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Purchase $purchase)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Purchase $purchase)
    {

        Gate::authorize('delete', $purchase);

        $purchase->delete();

        return redirect()->route('purchases.index')->with('success', 'Purchase item is removed!');
    }
}
