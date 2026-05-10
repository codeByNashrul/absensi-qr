<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SchoolClass;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class StudentController extends Controller
{
    public function index()
    {
        $students = Student::with('schoolClass')->latest()->get();

        return view('admin.students.index', compact('students'));
    }

    public function create()
    {
        $classes = SchoolClass::all();

        return view('admin.students.create', compact('classes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'school_class_id' => 'required',
            'nis' => 'required|unique:students',
            'name' => 'required',
            'gender' => 'required',
        ]);

        Student::create([
            'school_class_id' => $request->school_class_id,
            'nis' => $request->nis,
            'name' => $request->name,
            'gender' => $request->gender,
            'qr_token' => Str::uuid(),
        ]);

        return redirect('/admin/students')
            ->with('success', 'Siswa berhasil ditambahkan.');
    }
}