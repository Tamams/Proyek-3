<?php
namespace App\Controllers;

use App\Models\CourseModel;
use App\Models\UserModel;
use App\Models\EnrollmentModel; // Ditambahkan

class Admin extends BaseController
{
    public function index()
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $courseModel = new CourseModel();
        $userModel = new UserModel();

        return view('admin/index', [
            'courses'  => $courseModel->findAll(),
            'students' => $userModel->where('role', 'student')->findAll()
        ]);
    }

    public function addCourse()
    {
        $courseName = $this->request->getPost('course_name');
        if (!$courseName) {
            session()->setFlashdata('error_course_name', 'Nama course wajib diisi');
            return redirect()->back()->withInput();
        }
        $courseModel = new CourseModel();
        $courseModel->insert([
            'course_name' => $this->request->getPost('course_name'),
            'description' => $this->request->getPost('description'),
            'created_at'  => date('Y-m-d H:i:s')
        ]);

        return redirect()->to('/admin')->with('message', 'Course berhasil ditambahkan!');
    }

    public function deleteCourse($courseId)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }

        $courseModel = new CourseModel();
        $courseModel->delete($courseId);

        return redirect()->to('/admin')->with('message', 'Course berhasil dihapus!');
    }

    public function addStudent()
    {
        $username = $this->request->getPost('username');
        $fullName = $this->request->getPost('full_name');
        $password = $this->request->getPost('password');

        // Validasi sederhana
        if (!$username) {
            session()->setFlashdata('error_username', 'Username wajib diisi');
            return redirect()->back()->withInput();
        }
        if (!$fullName) {
            session()->setFlashdata('error_full_name', 'Nama lengkap wajib diisi');
            return redirect()->back()->withInput();
        }
        if (!$password) {
            session()->setFlashdata('error_password', 'Password wajib diisi');
            return redirect()->back()->withInput();
        }

        $userModel = new \App\Models\UserModel();
        // Cek duplikasi username
        if ($userModel->where('username', $username)->countAllResults() > 0) {
            session()->setFlashdata('error_username', 'Username sudah digunakan');
            return redirect()->back()->withInput();
        }

        $userModel->insert([
            'username' => $username,
            'full_name' => $fullName,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
            'role' => 'student'
        ]);

        session()->setFlashdata('success', 'Mahasiswa berhasil ditambahkan');
        return redirect()->back();
    }

    public function deleteStudent($userId)
    {
        if (!session()->get('logged_in') || session()->get('role') !== 'admin') {
            return redirect()->to('/login');
        }
        
        $userModel = new UserModel();
        $enrollmentModel = new EnrollmentModel(); // Instansiasi model

        // Cek apakah user yang akan dihapus memiliki role 'student'
        $user = $userModel->find($userId);
        if ($user && $user['role'] === 'student') {
            // Hapus semua data enrollments mahasiswa terlebih dahulu
            $enrollmentModel->where('user_id', $userId)->delete();
            
            // Kemudian hapus data mahasiswa itu sendiri
            $userModel->delete($userId);
            
            return redirect()->to('/admin')->with('message', 'Mahasiswa berhasil dihapus!');
        }

        return redirect()->to('/admin')->with('error', 'Gagal menghapus mahasiswa.');
    }
}