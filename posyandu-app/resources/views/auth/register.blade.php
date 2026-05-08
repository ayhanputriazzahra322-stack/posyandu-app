<!DOCTYPE html>
<html>
<head>
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-light d-flex justify-content-center align-items-center" style="height: 100vh;">

<div class="col-md-4">

    <div class="card shadow p-4">
        <h3 class="text-center mb-3">Register</h3>

        <form method="POST" action="/register">
            @csrf

            <input type="text" name="name" class="form-control mb-3" placeholder="Nama">
            <input type="email" name="email" class="form-control mb-3" placeholder="Email">
            <input type="password" name="password" class="form-control mb-3" placeholder="Password">

           <button class="btn btn-primary w-100">Daftar</button>

            <a href="/login" class="d-block mt-3 text-center">Sudah punya akun? Login</a>
        </form>
    </div>

</div>

</body>
</html>