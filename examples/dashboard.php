<?php
include "navbar.php";

$sqljumlahcalon = "SELECT COUNT(calon_ketua.id_calon) AS jumlah_calon FROM calon_ketua";
$simpanjumlahcalon = mysqli_query($koneksi, $sqljumlahcalon);
$jumlah_calon = mysqli_fetch_assoc($simpanjumlahcalon)['jumlah_calon'] ?? 0;

$sqlcaloninfo = "SELECT calon_ketua.nama, calon_ketua.kelas,calon_ketua.visi, calon_ketua.foto, COUNT(voting.id_calon) AS jumlah_vote
             FROM calon_ketua
             JOIN voting ON calon_ketua.id_calon = voting.id_calon
             GROUP BY calon_ketua.id_calon, calon_ketua.nama, calon_ketua.foto
             ORDER BY jumlah_vote DESC";

$simpancaloninfo = mysqli_query($koneksi, $sqlcaloninfo);


$sqljumlahsuara = "SELECT COUNT(voting.id_voting) AS jumlah_suara FROM voting";
$simpanjumlahsuara = mysqli_query($koneksi, $sqljumlahsuara);
$jumlah_suara= mysqli_fetch_assoc($simpanjumlahsuara)['jumlah_suara'] ?? 0;

$sqlleadcalon = "SELECT calon_ketua.nama, calon_ketua.foto, calon_ketua.kelas, COUNT(voting.id_calon) AS `lead`
                 FROM calon_ketua
                 LEFT JOIN voting ON calon_ketua.id_calon = voting.id_calon
                 GROUP BY calon_ketua.id_calon, calon_ketua.nama, calon_ketua.foto
                 ORDER BY `lead` DESC LIMIT 1";


                 

$simpanleadcalon = mysqli_query($koneksi, $sqlleadcalon);

$sqlcalon = "SELECT calon_ketua.nama, COUNT(voting.id_calon) AS jumlah_vote
             FROM calon_ketua
             JOIN voting ON calon_ketua.id_calon = voting.id_calon
             GROUP BY calon_ketua.id_calon, calon_ketua.nama
             ORDER BY jumlah_vote DESC";
$simpancalon = mysqli_query($koneksi, $sqlcalon);

$nama_array = [];
$vote_array = [];

while ($data = mysqli_fetch_assoc($simpancalon)) {
    $nama_array[] = $data['nama'];
    $vote_array[] = (int)$data['jumlah_vote'];
}
?>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<div class="content">
  <div class="d-flex flex-row-reverse">

    <div class="container">
    <div class="col">
      <div class="card text-center  pt-5">
        <div class="card-header bg-transparent">
          <h5 class="card-category fs-4">Jumlah Calon</h5> 
          <h1 class="display-4 fw-bold text-primary"><?= $jumlah_calon; ?></h1>
        </div>
        <div class="card-body">
          <p>Total calon yang tersedia untuk voting.</p>
        </div>
      </div>
    </div>

   
    <div class="col">
      <div class="card text-center pt-5">
        <div class="card-header bg-transparent">
          <h5 class="card-category fs-4">Jumlah Suara</h5> 
          <h1 class="display-4 fw-bold text-primary"><?= $jumlah_suara; ?></h1>
        </div>
        <div class="card-body">
          <p>Total suara yang mengikuti voting.</p>
        </div>
      </div>
    </div>

</div>
    <?php foreach ($simpanleadcalon as $datalead): ?>
      <div class="col-md-4 mb-4">
        <div class="card text-center h-100">
          <div class="card-header bg-transparent">
            <h5 class="card-category fs-4">Top Calon</h5>
            <h2 class="fw-bold text-primary"><?= ($datalead['nama']); ?></h2>
             <p class="fw-bold text-primary"><?= ($datalead['kelas']); ?></p>
          </div>
          <div class="card-body">
            <img src="../uploads/<?= ($datalead['foto']); ?>" 
                 alt="Foto <?= ($datalead['nama']); ?> " 
                 class="img-fluid rounded mb-2 " style="max-height: 150px;">  
                  <p>Calon dengan suara terbanyak.</p>
                  <h2 class="fw-bold text-primary"><?= ($datalead['lead']); ?></h2>
         
           
          </div>
        </div>
      </div>
    <?php endforeach; ?>

  </div>
<div class="row">
    <?php foreach ($simpancaloninfo as $data): ?>
      <div class="col-lg-4">
        <div class="card card-chart">
          <div class="card-header">
            <h3><?= ($data['nama']); ?></h3>
             <h4><?= ($data['kelas']); ?></h4>
              <p><?= ($data['visi']); ?></p>
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
  <!-- Chart Section -->
  <div class="row">
    <div class="col-12">
      <div class="card mt-4">
        <div class="card-header">
          <h5 class="card-category">Statistik Voting</h5>
          <h1 class="card-title">Jumlah Suara Calon Ketua</h1>
        </div>
        <div class="card-body">
          <canvas id="voteChart"></canvas>
        </div>
      </div>
    </div>
  </div>
</div>


  <!-- Chart Script -->
  <script>
    const ctx = document.getElementById('voteChart').getContext('2d');
    const voteChart = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: <?= json_encode($nama_array) ?>,
        datasets: [{
          label: 'Jumlah Vote',
          data: <?= json_encode($vote_array) ?>,
          backgroundColor: 'rgba(255, 0, 238, 0.2)',
          borderColor: 'rgb(255, 0, 174)',
          borderWidth: 1
        }]
      },
      options: {
        responsive: true,
        scales: {
          y: {
            beginAtZero: true,
            precision: 0
          }
        }
      }
    });
  </script>

  <!-- Tasks and Table Section (no changes made here) -->
  <!-- You can leave this as-is or make it dynamic later -->

</div>
