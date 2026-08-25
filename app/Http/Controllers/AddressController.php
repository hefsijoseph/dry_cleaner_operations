<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
     public function __construct()
    {
      $this->middleware(['permission:address-list|address-create|address-edit|address-delete'],["only" => ["index","show" ]]);
      $this->middleware(['permission:address-create'],["only" => ["create","store" ]]);
      $this->middleware(['permission:address-edit'],["only" => ["edit","update" ]]);
      $this->middleware(['permission:address-delete'],["only" => ["destroy" ]]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::latest()->get();
         $authEmployee = Auth::guard('employee')->user();
        return view("addresses.index", compact("addresses","authEmployee"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("addresses.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
             $validated = $request->validate([
            'address' => 'required|string|max:30',
        ]);

        Address::create($validated);

        return  redirect()->route('addresses.index')->with('success','Address created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $address = Address::findOrFail($id);
        return view("addresses.show", compact("address"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $address = Address::findOrFail($id);
        return view("addresses.edit", compact("address"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
            $request->validate([
             'address' => 'required|string|max:30',
        ]);

        $address = Address::findOrFail($id);
        $address->address = $request->address;

        $address->save();
          return redirect()->route("addresses.index")->
        with("success", "Address updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return redirect()->route("addresses.index")->
        with("deleted", "Address deleted successfully.");
    }
}
