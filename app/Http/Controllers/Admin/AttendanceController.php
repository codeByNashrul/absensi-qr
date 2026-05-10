<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Attendance;

class AttendanceController extends Controller
{
    public function index()
    {
        $query = Attendance::with([
            'student.schoolClass',
            'session.activity'
        ]);

        if (request('date')) {
            $query->whereDate('scan_time', request('date'));
        }

        if (request('activity_id')) {
            $query->whereHas('session', function ($q) {
                $q->where('activity_id', request('activity_id'));
            });
        }

        $attendances = $query->latest()->get();

        $activities = \App\Models\Activity::all();

        return view('admin.attendances.index', compact('attendances', 'activities'));
    }
    public function export()
    {
        $attendances = \App\Models\Attendance::with([
            'student.schoolClass',
            'session.activity'
        ])->latest()->get();

        $filename = 'rekap-absensi.csv';

        $callback = function () use ($attendances) {
            $file = fopen('php://output', 'w');

            fputcsv($file, ['Nama Siswa', 'Kelas', 'Kegiatan', 'Status', 'Waktu Scan'], ';');

            foreach ($attendances as $attendance) {
                fputcsv($file, [
                    $attendance->student->name,
                    $attendance->student->schoolClass->name,
                    $attendance->session->activity->name,
                    $attendance->status,
                    $attendance->scan_time,
                ], ';');
            }

            fclose($file);
        };

        return response()->streamDownload($callback, $filename);
    }
}
