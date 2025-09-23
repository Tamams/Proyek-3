<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h2>Login</h2>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= session()->getFlashdata('error') ?></div>
    <?php endif; ?>
    <form method="post" action="/auth/doLogin">
        <div class="mb-3">
            <label>Username</label>
            <input type="text" name="username"
                class="form-control <?= session()->getFlashdata('error_login') ? 'is-invalid' : '' ?>"
                value="<?= old('username') ?>" required>
            <?php if (session()->getFlashdata('error_login')): ?>
                <div class="invalid-feedback">
                    <?= session()->getFlashdata('error_login') ?>
                </div>
            <?php endif; ?>
        </div>
        <div class="mb-3">
            <label>Password</label>
            <input type="password" name="password" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Login</button>
    </form>
</body>
</html>
