<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">MyApp</a>

    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="<?= site_url('dashboard') ?>">Dashboard</a>
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('courses') ?>">Courses</a>
        </li>
      </ul>
    </div>

    <div class="d-flex align-items-center gap-3">
      <span class="navbar-text text-white">
        Halo, <b><?= session()->get('full_name') ?: session()->get('username') ?></b>
      </span>
      <a href="<?= site_url('logout') ?>" class="btn btn-outline-light btn-sm">Logout</a>
    </div>
  </div>
</nav>

<div class="container mt-4">
    <h1>Selamat datang di Dashboard 🎉</h1>
    <p>Ini halaman khusus sesuai role: <b><?= session()->get('role') ?></b></p>
    
    <hr>
    
    <h3>Courses yang Anda Ikuti</h3>
    <?php if (empty($enrolledCourses)): ?>
        <p>Anda belum mendaftar di Courses manapun.</p>
    <?php else: ?>
        <ul class="list-group">
            <?php foreach ($enrolledCourses as $course): ?>
                <li class="list-group-item">
                    <h5><?= esc($course['course_name']) ?></h5>
                    <p class="mb-0"><?= esc($course['description']) ?></p>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>