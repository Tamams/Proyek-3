<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Courses</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>


<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MyApp</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="<?= site_url('dashboard') ?>">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('courses') ?>">Courses</a>
        </li>
      </ul>
    </div>
    <div class="d-flex align-items-center gap-3">
      <span class="navbar-text text-white">
        Halo, <b><?= session()->get('full_name') ?: session()->get('username') ?></b>
      </span>
      <a href="<?= site_url('logout') ?>" class="btn btn-outline-light btn-sm"
         onclick="return confirm('Yakin ingin logout?')">Logout</a>
    </div>
  </div>
</nav>

<!-- Konten utama -->
<div class="container mt-4">
    <h2 class="mb-3">Course yang Kamu Enroll</h2>
    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama Course</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (empty($enrolledCourses)): ?>
                <tr>
                    <td colspan="4" class="text-center">Belum ada course yang di-enroll.</td>
                </tr>
            <?php else: ?>
                <?php foreach ($enrolledCourses as $i => $c): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($c['course_name']) ?></td>
                        <td><?= esc($c['description']) ?></td>
                    </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </tbody>
    </table>
</div>

<!-- Konfigurasi JS -->
<script>
    const BASE_URL = "<?= base_url() ?>";
    const USER_ID = "<?= session()->get('user_id') ?>";
</script>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        loadCourses();
    });

    // Fungsi mengambil data course dari API
    function loadCourses() {
        fetch(`${BASE_URL}/index.php/courses/api`)
            .then(res => res.json())
            .then(data => {
                const tbody = document.getElementById('courses-table-body');
                tbody.innerHTML = '';

                if (data.length === 0) {
                    tbody.innerHTML = `
                        <tr>
                            <td colspan="4" class="text-center">Belum ada course tersedia.</td>
                        </tr>
                    `;
                    return;
                }

                data.forEach((course, index) => {
                    tbody.innerHTML += `
                        <tr>
                            <td>${index + 1}</td>
                            <td>${course.course_name}</td>
                            <td>${course.description}</td>
                            <td>
                                <button class="btn btn-success btn-sm" onclick="enrollCourse(${course.id})">
                                    Enroll
                                </button>
                            </td>
                        </tr>
                    `;
                });
            })
            .catch(err => {
                console.error('Error fetching courses:', err);
            });
    }

    // Fungsi untuk enroll ke course
    function enrollCourse(courseId) {
        fetch(`${BASE_URL}/index.php/courses/enroll`, {
            method: 'POST',
            headers: { 'Content-Type': 'application/json' },
            body: JSON.stringify({ user_id: USER_ID, course_id: courseId })
        })
        .then(res => res.json())
        .then response => {
            showAlert(response.message, response.status);
        })
        .catch(err => {
            console.error('Error enrolling course:', err);
        });
    }

    // Fungsi menampilkan alert
    function showAlert(message, type) {
        const alertArea = document.getElementById('alert-area');
        const alertType = type === 'success' ? 'alert-success' : 'alert-danger';
        alertArea.innerHTML = `
            <div class="alert ${alertType}">${message}</div>
        `;

        setTimeout(() => alertArea.innerHTML = '', 3000);
    }
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
