<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\AttendanceSession;
use Illuminate\Http\Request;
use App\Models\Attendance;
use App\Models\Student;


class AttendanceSessionController extends Controller
{
    public function index()
    {
        $sessions = AttendanceSession::with('activity')
            ->latest()
            ->get();

        return view('admin.sessions.index', compact('sessions'));
    }

    public function create()
    {
        $activities = Activity::all();

        return view('admin.sessions.create', compact('activities'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'activity_id' => 'required',
            'title' => 'required',
            'date' => 'required',
            'start_time' => 'required',
            'end_time' => 'required',
        ]);

        AttendanceSession::create([
            'activity_id' => $request->activity_id,
            'operator_id' => auth()->id(),
            'title' => $request->title,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_active' => true,
        ]);

        return redirect('/admin/sessions')
            ->with('success', 'Sesi absensi berhasil dibuat.');
    }

    public function scanner($id)
    {
        $session = AttendanceSession::with('activity')->findOrFail($id);

        return view('admin.sessions.scanner', compact('session'));
    }

    public function scan(Request $request, $id)
    {
        $student = Student::where('qr_token', $request->qr_token)->first();

        if (!$student) {
            return response()->json([
                'success' => false,
                'message' => 'Siswa tidak ditemukan'
            ]);
        }

        $already = Attendance::where('attendance_session_id', $id)
            ->where('student_id', $student->id)
            ->exists();

        if ($already) {
            return response()->json([
                'success' => false,
                'message' => 'Siswa sudah absen'
            ]);
        }

        Attendance::create([
            'attendance_session_id' => $id,
            'student_id' => $student->id,
            'status' => 'hadir',
            'scan_time' => now(),
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Absensi berhasil',
            'student' => $student->name
        ]);
    }
    public function show(Request $request, $id)
    {
        $session = AttendanceSession::with([
            'activity',
            'attendances.student.schoolClass'
        ])->findOrFail($id);

        $students = \App\Models\Student::with('schoolClass')

            ->when($request->class_id, function ($query) use ($request) {
                $query->where('school_class_id', $request->class_id);
            })

            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($q) use ($request) {
                    $q->where('name', 'like', '%' . $request->search . '%')
                        ->orWhere('nis', 'like', '%' . $request->search . '%');
                });
            })

            ->paginate(25)
            ->withQueryString();

        $classes = \App\Models\SchoolClass::all();

        return view('admin.sessions.show', compact(
            'session',
            'students',
            'classes'
        ));
    }
    public function manualAttendance(Request $request, $id)
    {
        $request->validate([
            'student_id' => 'required',
            'status' => 'required|in:hadir,izin,sakit,alfa',
        ]);

        Attendance::updateOrCreate(
            [
                'attendance_session_id' => $id,
                'student_id' => $request->student_id,
            ],
            [
                'status' => $request->status,
                'scan_time' => now(),
            ]
        );

        return back()->with('success', 'Status absensi berhasil disimpan.');
    }
}
