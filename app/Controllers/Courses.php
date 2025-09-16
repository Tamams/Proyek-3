<?php
namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\EnrollmentModel;

class Courses extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in')) {
            return redirect()->to('/login');
        }

        $courseModel = new CourseModel();
        $courses = $courseModel->findAll();

        return view('courses/courses_index', ['courses' => $courses]);
    }

    public function enroll($courseId)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'student') {
            return redirect()->to('/login');
        }

        $enrollmentModel = new EnrollmentModel();
        $enrollmentModel->insert([
            'user_id'    => session()->get('user_id'),
            'course_id'  => $courseId,
            'enrolled_at'=> date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/courses')->with('message', 'Berhasil enroll course!');
    }
}
