<?php
include "../koneksi.php";
  $alert= null;
if (isset($_GET['id_admin'])) {
    $id_admin = intval($_GET['id_admin']); // Sanitize input
  
    // Secure deletion using prepared statement
    $stmt = $koneksi->prepare("DELETE FROM admin WHERE id_admin = ?");
    $stmt->bind_param("i", $id_admin);
    $delete = $stmt->execute();

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

  
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

<?php if ($alert === "success") : ?>
  <script>
    Swal.fire({
      title: "Berhasil",
      text: "Data admin berhasil dihapus!",
      icon: "success",
      confirmButtonColor: "#c531a0",
      background: "#212529",
      color: "#fff"
    }).then(() => {
      window.location.href = "admin.php";
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

