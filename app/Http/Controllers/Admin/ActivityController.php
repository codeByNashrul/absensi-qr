<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\ActivityCategory;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    public function index()
    {
        $activities = Activity::with('category')->latest()->get();

        return view('admin.activities.index', compact('activities'));
    }

    public function create()
    {
        $categories = ActivityCategory::all();

        return view('admin.activities.create', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_category_id' => 'required',
            'name' => 'required|string|max:255',
            'description' => 'nullable',
        ]);

        Activity::create([
            'activity_category_id' => $request->activity_category_id,
            'name' => $request->name,
            'description' => $request->description,
        ]);

        return redirect('/admin/activities')
            ->with('success', 'Kegiatan berhasil ditambahkan.');
    }
}