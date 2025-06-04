<?php
include "navbar.php";
 $no = 1;
$sqlcalon = "SELECT calon_ketua.nama, calon_ketua.kelas, calon_ketua.foto, COUNT(voting.id_calon) AS jumlah_vote
             FROM calon_ketua
             JOIN voting ON calon_ketua.id_calon = voting.id_calon
             GROUP BY calon_ketua.id_calon, calon_ketua.nama, calon_ketua.foto
             ORDER BY jumlah_vote DESC";

$sqltabel = "SELECT calon_ketua.nama,  voting.id_voting, voting.waktu 
             FROM voting
             JOIN calon_ketua ON voting.id_calon = calon_ketua.id_calon
             ORDER BY voting.id_voting DESC";

$simpancalon = mysqli_query($koneksi, $sqlcalon);
$simpantabel = mysqli_query($koneksi, $sqltabel);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard Voting</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Core CSS -->
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="../assets/css/black-dashboard.css?v=1.0.0">

  <!-- DataTables CSS -->
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
</head>
<body>

<div class="content">
  <div class="row">
    <?php foreach ($simpancalon as $data): ?>
      <div class="col-lg-4">
        <div class="card card-chart">
          <div class="card-header">F
            <h3><?= ($data['nama']); ?></h3>
             <h4><?= ($data['kelas']); ?></h4>

            <h3 class="card-title">
              <i class="tim-icons icon-single-02 text-primary"></i> Total Suara: <?= ($data['jumlah_vote']); ?>
            </h3>
          </div>
          <div class="card- p-3">
            <img src="../uploads/<?= ($data['foto']); ?>" 
                 alt="Foto <?= ($data['nama']); ?>" 
                 class="img-fluid rounded">
          </div>
        </div>
      </div>
    <?php endforeach; ?>
  </div>

  <div class="row mt-4">
    <div class="col">
      <div class="card">
        <div class="card-header">
          <h4 class="card-title">Data Voting</h4>
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="votingTable" class="table display">
              <thead class="text-primary">
                <tr>
                    <th>No</th>
                  <th>Nama</th>
                  <th>ID Voting</th>
                  <th>Waktu</th>
                </tr>
              </thead>
              <tbody><?php $no = 1; ?>
                <?php foreach ($simpantabel as $tabel): ?>
                  <tr>
                    <td><?= $no++; ?></td>
                    <td><?= ($tabel['nama']); ?></td>
                    <td><?= ($tabel['id_voting']); ?></td>
                    <td><?= ($tabel['waktu']); ?></td>
                  </tr>
                  
                <?php endforeach; ?>
              </tbody>
              
            </table>
                  
          </div>
        </div>
      </div>
    </div>
  </div><div class="row mt-4">
    <div class="col">
      <div class="card">
        <div class="card-header">
         
        </div>
        <div class="card-body">
          <div class="table-responsive">
            <table id="votingTable2" class="table display">
              <thead class="text-primary">
                <tr>
                    <th>No</th>
                  <th>Nama</th>
                  <th>kelas</th>
                  <th>Total Suara</th>
                </tr>
              </thead>
              <tbody>
                <?php $no = 1; ?>
                <?php foreach ($simpancalon as $calontabel): ?>
                  <tr>
                       <td><?= $no++; ?></td>
                    <td><?= ($calontabel['nama']); ?></td>
                    <td><?= ($calontabel['kelas']); ?></td>
                    <td><?= ($calontabel['jumlah_vote']); ?></td>
                  </tr>
                  
                <?php endforeach; ?>
              </tbody>
              
            </table>
                  
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
</div>

<!-- Core JS -->
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
<script src="../assets/js/plugins/chartjs.min.js"></script>
<script src="../assets/js/plugins/bootstrap-notify.js"></script>
<script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script>

<!-- DataTables JS (after jQuery) -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

<!-- DataTables Init -->
<script>
  $(document).ready(function() {
    $('#votingTable').DataTable({
      pageLength: 6,
      lengthChange: false, // Hide "Show entries" dropdown
      searching: false,     // Hide search bar
      order: [[3, 'desc']]
    });
  });
</script>
<script>
  $(document).ready(function() {
    $('#votingTable2').DataTable({
      pageLength: 6,
      lengthChange: false, // Hide "Show entries" dropdown
      searching: false,     // Hide search bar
      order: [[3, 'desc']]
    });
  });
</script>
</body>
</html>
