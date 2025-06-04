<?php
include "../koneksi.php";
$alert = ""; // prepare an alert variable

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    $query = "SELECT * FROM admin WHERE username='$username' AND password='$password'";
    $result = mysqli_query($koneksi, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $alert = "success";
    } else {
        $alert = "error";
    }
}
?>



<!-- CSS only -->
<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Black Dashboard by Creative Tim
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <!-- <style>
    /* .swal-modal {
  background-color: #212529;
  border: 3px solid white;
}

  .swal-button {
  padding: 7px 19px;
  border-radius: 2px;
  background-color: rgb(197, 49, 160);
  font-size: 12px;
  color: white;
}
.swal-icon--success:after, 
.swal-icon--success:before {
  background-color: #212529;
}

</style> */ -->
</head> 

<body class="bg-gray-900 d-flex align-items-center" style="height: 100vh; ">
<div class="container ">
  <div class="row justify-content-center">
  <div class="card">
  <div class="card-body">
    <form method="post">
      <div class="form-group">
        <label for="exampleInputEmail1">Username</label>
        <input type="text" class="form-control" name="username">
      
      </div>
      <div class="form-group">
        <label for="exampleInputPassword1">Password</label>
        <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password" name="password">
      </div>
    
        
   

      <button name="simpan" type="submit" class="btn btn-primary " value="login">Submit</button>
    </form>
  </div>
</div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<?php if ($alert == "success") : ?>
  <script>
    Swal.fire({
      title: "Berhasil",
      text: "Login Berhasil!",
      icon: "success",
      confirmButtonColor: "#c531a0",
      background: "#212529",
      color: "#fff"
    }).then(() => {
      window.location.href = "dashboard.php";
    });
  </script>


<?php elseif ($alert == "error") : ?>
   <script>
    Swal.fire({
      title: "Gagal",
      text: "Username atau password salah!",
      icon: "error",
      confirmButtonColor: "#c531a0",
      background: "#212529",
      color: "#fff"
    });
  </script>
<?php endif; ?>

</body>
</html>
