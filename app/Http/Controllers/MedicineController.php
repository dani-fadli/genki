<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Http\Request;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = Medicine::with('category')->paginate(10);

        return inertia('Dashboard/Medicine', [
            'medicines' => $medicines
        ]);
    }

    public function indexCatalogue()
    {
        $medicines = Medicine::all();

        return inertia('Catalogue');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Medicine::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'rating' => 0,
            'stock' => 0,
            'detail' => (object)$request->only([
                'description', 'reg_number', 'indication', 'contra_indication'
            ])
        ]);

        return redirect()->route('dashboard.medicine.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return inertia('Dashboard/MedicineCreate', [
            'categories' => Category::orderBy('name')->get(),
        ]);
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
    public function edit(Medicine $medicine)
    {
        return inertia('Dashboard/MedicineCreate', [
            'medicine' => $medicine,
            'isUpdating' => true,
            'categories' => Category::orderBy('name')->get(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Medicine $medicine)
    {
        $medicine->update([
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'detail' => (object)$request->only([
                'description', 'reg_number', 'indication', 'contra_indication'
            ]),
        ]);
        return redirect()->route('dashboard.medicine.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Medicine $medicine)
    {
        $medicine->delete();
        return redirect()->back();
    }
}
