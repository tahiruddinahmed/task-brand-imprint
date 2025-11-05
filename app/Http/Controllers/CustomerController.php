<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        Gate::authorize('viewany', Customer::class);

        $user = auth()->user();

        if($user->role === 'admin') {
            $customers = Customer::with('user')->latest()->get();
        } else if($user->role === 'employee') {
            $customers = Customer::where('user_id', $user->id)->get();
        }


        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        Gate::authorize('create', Customer::class);

        return view('customers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Gate::authorize('create', Customer::class);
        // if(!Gate::any(['employee', 'admin'])) {
        //     abort(403);
        // }

        $data = $request->validate([
            'name' => 'required|string|max:30',
            'phone' => 'required',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        
        Customer::create([
            ...$data,
            'address' => $request->address,
            'user_id' => $request->user()->id
        ]);

        return redirect()->route('customers.index')->with('success', 'A new customer is created');

        
    }

    /**
     * Show the form for editing the specified resource.
    */
    public function edit(Customer $customer)
    {
        Gate::authorize('viewany', Customer::class);

        return view('customers.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Customer $customer)
    {
        Gate::authorize('update', $customer);

        // if(!Gate::any(['employee', 'admin'])) {
        //     abort(403);
        // }

        
        $data = $request->validate([
            'name' => 'required|string|max:30',
            'phone' => 'required',
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:'.User::class],
        ]);

        $customer->update([
            ...$data,
            'address' => $request->address,
            'user_id' => $customer->user->id
        ]);

        return redirect()->route('customers.index')->with('success', 'Customer Infomation updated Successfully');
    }


    /**
     * Trash data 
     */
    public function trashIndex() {
        Gate::authorize('viewany', Customer::class);


        $user = auth()->user();

        if($user->role === 'admin') {
            $customers = Customer::onlyTrashed()->get();
        } else if($user->role === 'employee') {
            $customers = Customer::onlyTrashed()->where('user_id', $user->id)->get();
        }

        return view('customers.Trash.index', compact('customers'));
    }

    /**
     * restore trash data
     */
    public function restore(Customer $customer) {

        Gate::authorize('restore', $customer);

        $customer->restore();

        return redirect()->route('customers.trash')->with('success', 'One Customer is restored!');
    }

    /**
     * Temporary delete
     */
    public function softDelete(Customer $customer) {

        Gate::authorize('delete', $customer);

        $customer->delete();

        return redirect()->route('customers.index')->with('success', 'Customer is move into the trash, you can retrieve it when you want');
        
    }
    
    
    /**
     * Remove the specified resource from storage.
    */
    public function forceDelete(Customer $customer)
    {

        Gate::authorize('forceDelete', $customer);

        $customer->forceDelete();
        
        return redirect()->route('customers.trash')->with('success', 'Customer is permanently deleted!');
    }
}
