<?php

namespace App\Http\Controllers;

use App\Models\Category;

class HomepageController extends Controller
{
    public function index()
    {
        return inertia('Homepage', [
            'categories' => Category::all()
        ]);
    }
}
