<?php $activeMenu = 'courses'; ?>
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
          <a class="nav-link<?= $activeMenu == 'dashboard' ? ' active' : '' ?>" href="<?= site_url('dashboard') ?>">Dashboard</a>
        </li>
        <li class="nav-item">
          <a class="nav-link<?= $activeMenu == 'courses' ? ' active' : '' ?>" href="<?= site_url('courses') ?>">Courses</a>
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
    <h1 class="mb-4">Daftar Courses 📚</h1>
    <div id="alert-area"></div>
    <table class="table table-bordered" id="courses-table">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Nama Course</th>
                <th>Deskripsi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <!-- Akan diisi otomatis oleh JavaScript -->
        </tbody>
    </table>
</div>

<script>
    const BASE_URL = "<?= rtrim(base_url(), '/') ?>";
    const USER_ID = "<?= session()->get('user_id') ?>";
</script>
<script src="<?= base_url('js/courses.js') ?>"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>