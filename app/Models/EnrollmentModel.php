<?php
namespace App\Models;

use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $allowedFields = ['user_id', 'course_id', 'enrolled_at'];

    // Fungsi untuk mendapatkan kursus yang di-enroll oleh user ID tertentu
    public function getEnrolledCoursesByUserId($userId)
    {
        return $this->select('courses.id, courses.course_name, courses.description')
                    ->join('courses', 'enrollments.course_id = courses.id')
                    ->where('enrollments.user_id', $userId)
                    ->findAll();
    }
}