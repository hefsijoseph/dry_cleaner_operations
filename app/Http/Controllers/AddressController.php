<?php

namespace App\Http\Controllers;

use App\Models\Address;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = Address::latest()->get();
        return view("addresses.index", compact("addresses"));
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

        return  redirect()->route('addresses.index')->with('added','Address added!');
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
        with("success", "address updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return redirect()->route("addresses.index")->
        with("success", "address deleted.");
    }
}
