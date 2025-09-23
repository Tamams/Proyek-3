document.addEventListener('DOMContentLoaded', () => {
    loadCourses();
});

// Fungsi untuk mengambil data courses dari API
function loadCourses() {
    fetch(`${BASE_URL}/index.php/courses/api`)
        .then(res => res.json())
        .then(data => {
            const tbody = document.querySelector('#courses-table tbody');
            tbody.innerHTML = '';

            if (!data || data.length === 0) {
                tbody.innerHTML = `<tr><td colspan="4" class="text-center">Belum ada course tersedia</td></tr>`;
                return;
            }

            data.forEach((course, index) => {
                tbody.innerHTML += `
                    <tr>
                        <td>${index + 1}</td>
                        <td>${course.course_name}</td>
                        <td>${course.description}</td>
                        <td>
                            ${course.enrolled
                                ? `<button class="btn btn-danger btn-sm" onclick="deleteEnroll(${course.id})">Hapus</button>`
                                : `<button class="btn btn-success btn-sm" onclick="enrollCourse(${course.id})">Enroll</button>`
                            }
                        </td>
                    </tr>
                `;
            });
        })
        .catch(err => {
            console.error('Error fetching courses:', err);
        });
}

// Fungsi hapus enroll
function deleteEnroll(courseId) {
    if (!confirm('Yakin ingin menghapus enroll course ini?')) return;
    fetch(`${BASE_URL}/index.php/courses/delete`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: USER_ID, course_id: courseId })
    })
    .then(res => res.json())
    .then(response => {
        showAlert(response.message, response.status);
        loadCourses();
    })
    .catch(err => {
        console.error('Error deleting enroll:', err);
    });
}

// Fungsi untuk enroll mahasiswa
function enrollCourse(courseId) {
    fetch(`${BASE_URL}/index.php/courses/enroll`, {
        method: 'POST',
        headers: { 'Content-Type': 'application/json' },
        body: JSON.stringify({ user_id: USER_ID, course_id: courseId })
    })
    .then(res => res.json())
    .then(response => {
        showAlert(response.message, response.status);
        loadCourses(); // reload courses after enroll
    })
    .catch(err => {
        console.error('Error enrolling course:', err);
    });
}



// Fungsi untuk menampilkan pesan alert
function showAlert(message, type) {
    const alertArea = document.getElementById('alert-area');
    const alertType = type === 'success' ? 'alert-success' : 'alert-danger';
    alertArea.innerHTML = `<div class="alert ${alertType}">${message}</div>`;

    setTimeout(() => alertArea.innerHTML = '', 3000);
}