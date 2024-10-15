<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Medicine;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MedicineController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $medicines = Medicine::with('category')->paginate(10);
        $medicines->getCollection()->transform(function ($medicine) {
            $medicine->medicine_image = $medicine->medicine_image
                ? Storage::url($medicine->medicine_image)
                : '/assets/default_medicine.png';
            return $medicine;
        });

        return inertia('Dashboard/Medicine', [
            'medicines' => $medicines
        ]);
    }

    public function indexCatalogue()
    {
        $medicines = Medicine::with('category')->paginate(10);
        $medicines->getCollection()->transform(function ($medicine) {
            $medicine->medicine_image = $medicine->medicine_image
                ? Storage::url($medicine->medicine_image)
                : '/assets/default_medicine.png';
            return $medicine;
        });

        return inertia('Catalogue', [
            'medicines' => $medicines,
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'medicine_image' => ['file', 'mimes:jpg,png,jpeg', 'max:1000'],
        ]);

        $file = $request->file('medicine_image');
        $filename = 'medicine_' . Str::random(10) . '_' . time() . '.' . $file->getClientOriginalExtension();
        if ($file->isValid()) $file->storeAs('', $filename);

        Medicine::create([
            'name' => $request->name,
            'category_id' => $request->category,
            'price' => $request->price,
            'rating' => 0,
            'stock' => 0,
            'detail' => (object)$request->only([
                'description', 'reg_number', 'indication', 'contra_indication'
            ]),
            'medicine_image' => $filename,
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
        $medicine = Medicine::find($id);
        $medicine->medicine_image = $medicine->medicine_image ? Storage::url($medicine->medicine_image) : '/assets/default_medicine.png';

        return inertia('MedicineDetail', [
            'medicine' => $medicine,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Medicine $medicine)
    {
        if ($medicine->medicine_image)
            $medicine->medicine_image = Storage::url($medicine->medicine_image);

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
