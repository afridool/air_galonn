<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="Mark Otto, Jacob Thornton, and Bootstrap contributors">
    <meta name="generator" content="Hugo 0.83.1">
    <title>Daftar Akun</title>

    <link rel="canonical" href="https://getbootstrap.com/docs/5.0/examples/sign-in/">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-+0n0xVW2eSR5OomGNYDnhzAbDsOXxcvSN1TPprVMTNDbiYZCxYbOOl7+AMvyTG2x" crossorigin="anonymous">


    

    <!-- Bootstrap core CSS -->
<link href="../assets/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
      .bd-placeholder-img {
        font-size: 1.125rem;
        text-anchor: middle;
        -webkit-user-select: none;
        -moz-user-select: none;
        user-select: none;
      }

      @media (min-width: 768px) {
        .bd-placeholder-img-lg {
          font-size: 3.5rem;
        }
      }
    </style>

    
    <!-- Custom styles for this template -->
    <link href="signin.css" rel="stylesheet">
  </head>
  <body class="text-center">
    
<main class="form-signin">
  <form action="proses/proses-register.php" method="post">
    <h1>AirGalonPku</h1><br><br>
    <h1 class="h3 mb-3 fw-normal">Daftar Akun</h1>
    <div class="form-floating">
      <input type="text" class="form-control" id="username" placeholder="Username" name="username" required>
      <label for="username">Username</label>
    </div>
    <div class="form-floating">
      <input type="password" class="form-control" id="Password" placeholder="Password" name="password" required>
      <label for="Password">Password</label>
    </div>
    <div class="form-floating">
        <input type="email" class="form-control" id="email" placeholder="Email" name="email" email required>
        <label for="email">Email</label>
    </div>
    <div class="form-floating">
        <input type="text" class="form-control" id="nama" placeholder="Nama Lengkap" name="nama" required>
        <label for="Nama">Nama Lengkap</label>
    </div>
    <div class="form-floating">
        <input type="text" class="form-control" id="email" placeholder="No. Telp" name="no_hp" required>
        <label for="Kontak">No. Hp</label>
    </div>
    <div class="form-floating">
        <textarea type="text" class="form-control" id="email" placeholder="Alamat" name="alamat" required></textarea>
        <label for="email">Alamat</label>
    </div><br>

    <button class="w-100 btn btn-lg btn-primary" type="submit" name="submit">Daftar Akun</button><br><br>
    <p>Sudah punya akun ? <a href="login.php" style="text-decoration: none;">Login</a> Sekarang</p>
    <p class="mt-5 mb-3 text-muted">&copy; AirGalonPku</p>
  </form>
</main>


    
  </body>
</html>
