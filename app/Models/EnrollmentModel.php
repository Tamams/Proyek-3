<?php

namespace App\Models;
use CodeIgniter\Model;

class EnrollmentModel extends Model
{
    protected $table = 'enrollments';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['user_id', 'course_id', 'created_at'];

    // Ambil daftar course yang di-enroll oleh user tertentu
    public function getEnrollmentsByUser($userId)
    {
        return $this->select('courses.id, courses.course_name, courses.description, enrollments.created_at')
                    ->join('courses', 'courses.id = enrollments.course_id')
                    ->where('enrollments.user_id', $userId)
                    ->findAll();
    }
}
