<?php
namespace App\Controllers;

use App\Models\EnrollmentModel;

class Dashboard extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $enrollmentModel = new EnrollmentModel();
        // Mengambil data kursus yang di-enroll oleh student ID yang sedang login
        $enrolledCourses = $enrollmentModel->getEnrolledCoursesByUserId(session()->get('user_id'));

        return view('dashboard/dashboard_index', [
            'username' => session()->get('username'),
            'role'     => session()->get('role'),
            'enrolledCourses' => $enrolledCourses // Mengirim data ke view
        ]);
    }
}