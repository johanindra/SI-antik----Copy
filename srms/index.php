<?php
// Sisipkan file koneksi.php untuk menghubungkan ke database
include("../server/koneksi.php");

// Ambil nilai yang dimasukkan oleh pengguna
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["logUsername"];
    $password = $_POST["logPassword"];

    // Query SQL untuk memeriksa apakah pengguna terdaftar di tabel admin
    $query = "SELECT * FROM admin WHERE UserName = :username AND Password = :password";
    $stmt = $dbh->prepare($query);
    $stmt->bindParam(':username', $username, PDO::PARAM_STR);
    $stmt->bindParam(':password', $password, PDO::PARAM_STR);
    $stmt->execute();

    if ($stmt->rowCount() == 1) {
        // Jika pengguna terdaftar, alihkan ke halaman welcome.php atau halaman lain yang sesuai
        header("Location: dashboard.php");
        exit();
    } else {
        // Jika pengguna tidak terdaftar, tampilkan pesan kesalahan
        echo "Username atau password salah. Silakan coba lagi.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="css/style.css" />
    <link
      rel="stylesheet"
      href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css"
      integrity="sha512-iecdLmaskl7CVkqkXNQ/ZH/XLlvWZOJyj7Yy7tcenmpD1ypASozpmT/E0iPtmFIB46ZmdtAc9eNBvH0H/ZpiBw=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    />
    <title>Form Login</title>
  </head>
  <body>
    <div class="container">
      <div class="box">
        <!-- Login Box -->
        <!-- ... Bagian HTML sebelumnya ... -->

<div class="box-login" id="login">
  <div class="top-header">
    <small>Selamat datang di SI-antik!</small>
    <h3>Admin Login</h3>
  </div>
  <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
    <div class="input-group">
      <div class="input-field">
        <input type="text" class="input-box" id="logUsername" name="logUsername" required />
        <label for="logUsername">Username</label>
      </div>
      <div class="input-field">
        <input type="password" class="input-box" id="logPassword" name="logPassword" required />
        <label for="logPassword">Password</label>
        <div class="eye-area">
          <div class="eye-box" onclick="myLogPassword()">
            <i class="fa-regular fa-eye" id="eye"></i>
            <i class="fa-regular fa-eye-slash" id="eye-slash"></i>
          </div>
        </div>
      </div>
      <div class="input-field-bt">
        <!-- Ganti tipe button menjadi "submit" agar bisa melakukan submit form -->
        <button type="submit" class="input-submit">Login</button>
      </div>
      <div class="forgot">
        <a href="lupa-password.php">Lupa password?</a>
      </div>
    </div>
  </form>
</div>

<!-- ... Bagian HTML setelahnya ... -->

      </div>
    </div>

    <script>
      var x = document.getElementById("login");

      function login() {
        x.style.left = "27px";
      }

      function myLogPassword() {
        var a = document.getElementById("logPassword");
        var b = document.getElementById("eye");
        var c = document.getElementById("eye-slash");

        if (a.type === "password") {
          a.type = "text";
          b.style.opacity = "0";
          c.style.opacity = "1";
        } else {
          a.type = "password";
          b.style.opacity = "1";
          c.style.opacity = "0";
        }
      }
    </script>
  </body>
</html>

