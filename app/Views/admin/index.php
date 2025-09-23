<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">Admin Dashboard</a>
            <div class="d-flex align-items-center gap-3">
                <span class="navbar-text text-white">
                    Halo, <b><?= session()->get('full_name') ?: session()->get('username') ?></b>
                </span>
                <a href="<?= site_url('logout') ?>" class="btn btn-outline-light btn-sm"
                   onclick="return confirm('Yakin ingin logout?')">Logout</a>
            </div>
        </div>
    </nav>

    <h2>Admin Panel</h2>

    <?php if (session()->getFlashdata('message')): ?>
        <div class="alert alert-success mt-3"><?= session()->getFlashdata('message') ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger mt-3"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>

    <div class="row">
        <div class="col-md-6">
            <h3 class="mt-4">Tambah Course Baru</h3>
            <form method="post" action="/admin/addCourse">
                <div class="mb-3">
                    <label>Nama Course</label>
                    <input type="text" name="course_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label>Deskripsi</label>
                    <textarea name="description" class="form-control"></textarea>
                </div>
                <button type="submit" class="btn btn-success">Tambah</button>
            </form>
        </div>
        <div class="col-md-6">
            <h3>Tambah Mahasiswa</h3>
            <form method="post" action="<?= site_url('admin/addStudent') ?>">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" name="username" id="username"
                        class="form-control <?= session()->getFlashdata('error_username') ? 'is-invalid' : '' ?>"
                        value="<?= old('username') ?>" required>
                    <?php if (session()->getFlashdata('error_username')): ?>
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('error_username') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="full_name" class="form-label">Nama Lengkap</label>
                    <input type="text" name="full_name" id="full_name"
                        class="form-control <?= session()->getFlashdata('error_full_name') ? 'is-invalid' : '' ?>"
                        value="<?= old('full_name') ?>" required>
                    <?php if (session()->getFlashdata('error_full_name')): ?>
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('error_full_name') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" name="password" id="password"
                        class="form-control <?= session()->getFlashdata('error_password') ? 'is-invalid' : '' ?>"
                        required>
                    <?php if (session()->getFlashdata('error_password')): ?>
                        <div class="invalid-feedback">
                            <?= session()->getFlashdata('error_password') ?>
                        </div>
                    <?php endif; ?>
                </div>
                <button type="submit" class="btn btn-primary">Tambah Mahasiswa</button>
            </form>
        </div>
    </div>
    
    <hr class="my-5">

    <div class="row">
        <div class="col-md-6">
            <h3>Daftar Courses</h3>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Course</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($courses)): ?>
                        <tr>
                            <td colspan="3" class="text-center">Belum ada course</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($courses as $i => $c): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= esc($c['course_name']); ?></td>
                                <td>
                                    <a href="<?= site_url('admin/deleteCourse/'.$c['id']) ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Yakin ingin menghapus course ini?')">Hapus</a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
        <div class="col-md-6">
            <h3>Daftar Students</h3>
            <table class="table table-bordered table-striped">
                <thead class="table-dark">
                    <tr>
                        <th>#</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($students)): ?>
                        <tr>
                            <td colspan="4" class="text-center">Belum ada mahasiswa terdaftar</td>
                        </tr>
                    <?php else: ?>
                        <?php foreach ($students as $i => $s): ?>
                            <tr>
                                <td><?= $i + 1 ?></td>
                                <td><?= esc($s['full_name']); ?></td>
                                <td><?= esc($s['username']); ?></td>
                                <td>
                                    <a href="<?= site_url('admin/deleteStudent/'.$s['id']) ?>" 
                                       onclick="return confirm('Apakah Anda yakin ingin menghapus mahasiswa ini?')"
                                       class="btn btn-danger btn-sm">
                                        Hapus
                                    </a>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>