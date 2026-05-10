<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ActivityCategory;
use Illuminate\Http\Request;

class ActivityCategoryController extends Controller
{
    public function index()
    {
        $categories = ActivityCategory::latest()->get();

        return view('admin.activity-categories.index', compact('categories'));
    }

    public function create()
    {
        return view('admin.activity-categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:100',
        ]);

        ActivityCategory::create([
            'name' => $request->name,
        ]);

        return redirect('/admin/activity-categories')->with('success', 'Kategori kegiatan berhasil ditambahkan.');
    }
}