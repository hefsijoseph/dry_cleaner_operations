<?php

namespace App\Http\Controllers;

use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Item::orderBy('created_at','desc')->paginate(15);
         $authEmployee = Auth::guard('employee')->user();
        return view("items.index", compact("items","authEmployee"));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("items.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
             $validated = $request->validate([
            'title' => 'required|string|max:30',
            'description' => 'required|string|max:50',
        ]);

        Item::create($validated);

        return  redirect()->route('items.index')->with('added','Item added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
         $item = Item::findOrFail($id);
        return view("items.show", compact("item"));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
         $item = Item::findOrFail($id);
        return view("items.edit", compact("item"));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
          $item = Item::findOrFail($id);
                $request->validate([
             'title' => 'required|string|max:30',
            'description' => 'required|string|max:50',
        ]);

      
        $item->title = $request->title;
         $item->description = $request->description;

        $item->save();
          return redirect()->route("items.index")->
        with("success", "Item updated");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          $item = Item::findOrFail($id);
        $item->delete();
        return redirect()->route("items.index")->
        with("success", "Item deleted.");
    }
}
