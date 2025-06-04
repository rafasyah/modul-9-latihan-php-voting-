   <?php
include "navbar.php";
include "../koneksi.php";

$id_admin = $_GET['id_admin'];
$sql = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
$result = mysqli_query($koneksi, $sql);
$ambil = mysqli_fetch_assoc($result);
$berhasil = false;
$alert="";
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];
    $nama_lengkap = $_POST["nama_lengkap"];
  

   

    $update = "UPDATE admin SET username = '$username', password = '$password', nama_lengkap = '$nama_lengkap' WHERE id_admin = $id_admin";
    $simpan = mysqli_query($koneksi, $update);

     if ($simpan) {
    $alert = "success";
} else {
    $alert = "error";
}
}
?>
<div class="content">
        
       
        
               
    <div class="container ">
    <div class="row justify-content-center">
    <div class="card">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="exampleInputEmail1">username</label>
            <input type="text" class="form-control" name="username" value="<?= $ambil
                                        ['username']?>" required>
        
        </div>

          

            <div class="form-group">
            <label >password</label>
            <input type="text" class="form-control" name="password" value="<?= $ambil
                                        ['password']?>" required>
        
        </div>

  <div class="form-group">
            <label >nama_lengkap</label>
            <input type="text" class="form-control" name="nama_lengkap" value="<?= $ambil
                                        ['nama_lengkap']?>" >
        
        </div>
         <button type="submit" class="btn btn-primary">Submit</button>

<?php if ($alert == "success") : ?>
  <script>
    Swal.fire({
      title: "Berhasil",
      text: "Edit Berhasil!",
      icon: "success",
      confirmButtonColor: "#c531a0",
      background: "#212529",
      color: "#fff"
    }).then(() => {
      window.location.href = "admin.php";
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

         