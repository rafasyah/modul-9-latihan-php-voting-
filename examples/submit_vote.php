<?php
include "../koneksi.php";

$alert = null; // Set default to avoid undefined variable

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $id_calon = $_POST['id_calon'];

    $stmt = $koneksi->prepare("INSERT INTO voting (id_calon, waktu) VALUES (?, NOW())");
    $stmt->bind_param("i", $id_calon);

    if ($stmt->execute()) {
        $alert = "success";
    } else {
        $alert = "error";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>
<body>

<?php if ($alert === "success") : ?>
  <script>
    Swal.fire({
      title: "Berhasil",
      text: "Voting berhasil dikirim!",
      icon: "success",
      confirmButtonColor: "#c531a0",
      background: "#212529",
      color: "#fff"
    }).then(() => {
      window.location.href = "index.php"; 
    });
  </script>
<?php elseif ($alert === "error") : ?>
  <script>
    Swal.fire({
      title: "Gagal",
      text: "Terjadi kesalahan saat mengirim voting.",
      icon: "error",
      confirmButtonColor: "#c531a0",
      background: "#212529",
      color: "#fff"
    });
  </script>
<?php endif; ?>

</body>
</html>