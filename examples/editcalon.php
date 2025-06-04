   <?php
include "navbar.php";
include "../koneksi.php";

$id_calon = $_GET['id_calon'];
$sql = "SELECT * FROM calon_ketua WHERE id_calon = '$id_calon'";
$result = mysqli_query($koneksi, $sql);
$ambil = mysqli_fetch_assoc($result);
$berhasil = false;
$error = "";
$alert = null;
if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $nama = $_POST["nama"];
    $kelas = $_POST["kelas"];
    $visi = $_POST["visi"];
    $foto = $ambil['foto']; // default to old foto

    // Handle uploaded file
   if (isset($_FILES['foto']) && $_FILES['foto']['error'] == 0) {
    $fotoName = time() . '_' . basename($_FILES['foto']['name']);
    $targetPath = "../uploads/$fotoName";
    if (move_uploaded_file($_FILES['foto']['tmp_name'], $targetPath)) {
        $foto = $fotoName;
    } else {
        $error = "Failed to move uploaded file.";
        $alert = "error";
    }
}
    $update = "UPDATE calon_ketua SET nama = '$nama', kelas = '$kelas', visi = '$visi', foto = '$foto' WHERE id_calon = $id_calon";
    $simpan = mysqli_query($koneksi, $update);

   if ($simpan) {
    $alert = "success";
} else {
    $alert = "error";
}
}
?>
<div class="content">
        
       
        
               
    <div class="container " style="">
    <div class="row justify-content-center">
    <div class="card">
    <div class="card-body">
        <form method="post" enctype="multipart/form-data" >
        <div class="form-group">
            <label for="exampleInputEmail1">nama</label>
            <input type="text" class="form-control" name="nama" value="<?= $ambil
                                        ['nama']?>" required>
        
        </div>

            <div class="form-group">
            <label >visi</label>
            <input type="text" class="form-control" name="visi" value="<?= $ambil
                                        ['visi']?>" required>
        
        </div>

            <div class="form-group">
            <label >kelas</label>
            <input type="text" class="form-control" name="kelas" value="<?= $ambil
                                        ['kelas']?>" required>
        
        </div>
<!-- Show current image preview -->
 <label>foto
 </label>
<?php if (!empty($ambil['foto'])): ?>
  <div class="mb-2">
    <img src="../uploads/<?= $ambil['foto'] ?>" alt="Foto calon" width="150">
    <p class="m-3">Preview</p>
  </div>
<?php endif; ?>

<input type="file" class="form-control" name="foto">
            
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
      window.location.href = "calonketua.php";
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
         