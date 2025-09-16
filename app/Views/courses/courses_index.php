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
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="<?= site_url('dashboard') ?>">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" href="<?= site_url('courses') ?>">Courses</a>
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

<!-- Konten Courses -->
<div class="container mt-4">
    <h2>Daftar Courses 📚</h2>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>

    <table class="table table-striped table-bordered mt-3">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama Course</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($courses)): ?>
                <?php foreach ($courses as $i => $course): ?>
                    <tr>
                        <td><?= $i + 1 ?></td>
                        <td><?= esc($course['course_name']); ?></td>
                        <td>
                            <a href="<?= site_url('courses/enroll/'.$course['id']); ?>" class="btn btn-success btn-sm">
                                Enroll
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            <?php else: ?>
                <tr>
                    <td colspan="3" class="text-center">Belum ada course tersedia</td>
                </tr>
            <?php endif; ?>
        </tbody>
    </table>

    <a href="<?= site_url('dashboard') ?>" class="btn btn-secondary">Kembali</a>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
