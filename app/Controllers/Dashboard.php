<?php

namespace App\Controllers;

use App\Models\EnrollmentModel;
use App\Models\CourseModel;

class Dashboard extends BaseController
{
    public function index()
    {
        $userId = session()->get('user_id');
        $enrollmentModel = new EnrollmentModel();
        $courseModel = new CourseModel();

        $enrollments = $enrollmentModel->where('user_id', $userId)->findAll();

        $enrolledCourses = [];
        foreach ($enrollments as $enroll) {
            $course = $courseModel->find($enroll['course_id']);
            if ($course) {
                $course['enrolled_at'] = $enroll['enrolled_at'];
                $enrolledCourses[] = $course;
            }
        }

        return view('dashboard/dashboard_index', [
            'enrolledCourses' => $enrolledCourses
        ]);
    }
}