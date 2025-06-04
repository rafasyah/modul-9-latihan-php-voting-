<?php include "../koneksi.php"; ?>

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
   <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
   <style>
  .calon .card {
    transition: transform 0.3s, box-shadow 0.3s;
    border: 2px solid transparent;
  }

  .calon [type="radio"]:checked + .card {
    border-color:rgb(197, 49, 160); /* green-blue highlight */
    box-shadow: 0 0 15px rgba(217, 21, 168, 0.7);
    transform: scale(1.05);
  }
</style>

</head>
<body>
 
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
     <a href="login.php"><button class="btn btn-primary m-3">Log in untuk masuk Dashboard</button> </a>
    <h2 class= "d-flex flex-wrap justify-content-center m-3">Vote Ketua OSIS</h2>
  <form method="POST" action="submit_vote.php">
    <div class="d-flex flex-wrap justify-content-center">
    <?php
    $query = "SELECT * FROM calon_ketua";
    $result = $koneksi->query($query);

    while ($row = $result->fetch_assoc()) {
?>
    <label class="calon" style="cursor: pointer;">
    <input type="radio" name="id_calon" value="<?php echo $row['id_calon']; ?>" required style="display: none;">
    <div class="card m-5" style="width: 20rem; height: 23rem; display: flex; flex-direction: column; justify-content: space-between;">
        <h3 class="card-text m-1 text-center"><?php echo $row['nama']; ?></h3>
           <h3 class="card-text text-center"><?php echo $row['kelas']; ?></h3>
        <div style="flex-grow: 1; display: flex; align-items: center; justify-content: center;">
            <img class="" src="../uploads/<?php echo $row['foto']; ?>" alt="<?php echo $row['nama']; ?>" style="max-height: 150px; object-fit: contain;">
        </div>
        <div class="card-body" style="overflow: hidden; text-overflow: ellipsis;">
            <p class="text-center" style="max-height: 100px; overflow: auto;"><?php echo $row['visi']; ?></p>
        </div>
    </div>
</label>
<?php
    }
?>   
    </div>
       <div class="d-flex flex-wrap justify-content-center">
    <br>   <button name="simpan" type="submit" class="btn btn-primary " value="">Submit</button>  </div>
</form>

</body>
</html>

