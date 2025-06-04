<?php
include "../koneksi.php";
$alert = null; // Set default alert to null

if (isset($_GET['id_calon'])) {
    $id_calon = intval($_GET['id_calon']); // sanitize input

    // optional: delete associated photo
    $get = mysqli_query($koneksi, "SELECT foto FROM calon_ketua WHERE id_calon = $id_calon");
    $data = mysqli_fetch_assoc($get);
    if ($data && file_exists("../uploads/" . $data['foto'])) {
        unlink("../uploads/" . $data['foto']);
    }

    $delete = mysqli_query($koneksi, "DELETE FROM calon_ketua WHERE id_calon = $id_calon");

    if ($delete) {
        $alert = "success";
    } else {
        $alert = "error";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Hapus Calon</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php if ($alert === "success") : ?>
  <script>
    Swal.fire({
      title: "Berhasil",
      text: "Data calon berhasil dihapus!",
      icon: "success",
      confirmButtonColor: "#c531a0",
      background: "#212529",
      color: "#fff"
    }).then(() => {
      window.location.href = "calonketua.php";
    });
  </script>
<?php elseif ($alert === "error") : ?>
  <script>
    Swal.fire({
      title: "Gagal",
      text: "Terjadi kesalahan saat menghapus data.",
      icon: "error",
      confirmButtonColor: "#c531a0",
      background: "#212529",
      color: "#fff"
    });
  </script>
<?php endif; ?>

</body>
</html>
