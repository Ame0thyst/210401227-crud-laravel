<?php

namespace App\Http\Controllers;

use App\Models\Categorie;
use Illuminate\Http\Request;

class CategorieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Categorie::latest()->paginate(5);
        return view('categories.index',compact('categories'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
                 'name' => 'required',
                 'detail' => 'required',
             ]);
       
             Categorie::create($request->all());
        
             return redirect()->route('categories.index')->with('success','Categorie created successfully.');
         }

    /**
     * Display the specified resource.
     */
    public function show(Categorie $categorie)
    {
        return view('categories.show',compact('categorie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Categorie $categorie)
    {
        return view('categories.edit',compact('categorie'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Categorie $categorie)
    {
        $request->validate([
            'name' => 'required',
            'detail' => 'required',
        ]);
  
        $categorie->update($request->all());
  
        return redirect()->route('categories.index')->with('success','Categorie updated successfully');
    }
    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Categorie $categorie)
    {
        $categorie->delete();

        return redirect()->route('categories.index')->with('success','Categorie deleted successfully');
    }
}
