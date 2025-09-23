<?php

namespace App\Controllers;
use App\Models\CourseModel;
use App\Models\EnrollmentModel;
use CodeIgniter\Controller;

class Courses extends Controller
{
    public function index()
    {
        return view('courses/courses_index');
    }

    // API untuk ambil data courses
    public function api()
    {
        $courseModel = new \App\Models\CourseModel();
        $enrollmentModel = new \App\Models\EnrollmentModel();
        $userId = session()->get('user_id');

        $courses = $courseModel->findAll();
        $enrolled = $enrollmentModel->where('user_id', $userId)->findAll();
        $enrolledIds = array_column($enrolled, 'course_id');

        foreach ($courses as &$course) {
            $course['enrolled'] = in_array($course['id'], $enrolledIds);
        }

        return $this->response->setJSON($courses);
    }

    public function delete()
    {
        $data = $this->request->getJSON();
        $enrollmentModel = new \App\Models\EnrollmentModel();

        $deleted = $enrollmentModel
            ->where('user_id', $data->user_id)
            ->where('course_id', $data->course_id)
            ->delete();

        if ($deleted) {
            return $this->response->setJSON(['status' => 'success', 'message' => 'Enroll berhasil dihapus']);
        } else {
            return $this->response->setJSON(['status' => 'error', 'message' => 'Gagal menghapus enroll']);
        }
    }

    // API untuk enroll course
    public function enroll()
    {
        $data = $this->request->getJSON();
        $enrollmentModel = new EnrollmentModel();

        // Cek apakah sudah terdaftar
        $exists = $enrollmentModel->where([
            'user_id'   => $data->user_id,
            'course_id' => $data->course_id
        ])->first();

        if ($exists) {
            return $this->response->setJSON([
                'status'  => 'error',
                'message' => 'Anda sudah terdaftar di course ini.'
            ]);
        }

        $enrollmentModel->insert([
            'user_id'   => $data->user_id,
            'course_id' => $data->course_id
        ]);

        return $this->response->setJSON([
            'status'  => 'success',
            'message' => 'Berhasil mendaftar course!'
        ]);
    }
}
