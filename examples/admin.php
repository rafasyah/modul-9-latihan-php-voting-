<?php
include "navbar.php";
include "../koneksi.php";

$current_page = basename($_SERVER['PHP_SELF']);

?>
<head><style>
.password-mask {
  position: relative;
  cursor: pointer;
}

.password-mask::after {
  content: attr(data-password);
  position: absolute;
  top: 0;
  left: 0;
  background: #fff;
  color: #000;
  padding: 2px 4px;
  border-radius: 4px;
  white-space: nowrap;
  z-index: 10;
  display: none;
  box-shadow: 0 0 5px rgba(0,0,0,0.2);
}

/* .password-mask:hover::after {
  display: inline-block;
} */
</style>
</head>
      <div class="content">
        <div class="row">
          <div class="col-md-12">
            <div class="card ">
              <div class="card-header">
                <h4 class="card-title"> Admin</h4>
              </div>
              <div class="card-body">
                <div class="table-responsive">
                  <table class="table tablesorter " id="">
                    <thead class=" text-primary">
                      <tr>
                        <th>
                          Username
                        </th>
                        <th>
                          Password
                        </th>
                        <th>
                          Nama
                        </th>
                      
                      </tr>
                    </thead>

                    <?php
              $no = 1;
              //sql
              $sql = "select * from admin order by id_admin DESC";
             
              //eksekusi
              $hasil = mysqli_query($koneksi, $sql);

              //tampilkan dgn perulangan?>
           

                    <tbody>  <?php foreach ($hasil as $data) {
              ?>
                      <tr> <td>
                           <?= $data['username'] ?>

                        </td>
                       <td>
  <span class="password-mask" data-password="<?= htmlspecialchars($data['password']) ?>">••••••••</span>
</td>

                       
                        <td>
                       <?= $data['nama_lengkap'] ?>
                        </td>
                        <td class="text-center">
                        

                        </td>
                         <td class= "align-middle text-center ">
                   <a href="editadmin.php?id_admin=<?= $data['id_admin']?>"> <button type="button" class="btn btn-success m-2">Edit</button></a>
           

                 <a href="deleteadmin.php?id_admin=<?= $data['id_admin']?>>" class="btn btn-danger m-2" onclick="return confirm('Konfirmasi untuk hapus?')">Delete</a>

                  </td>
                                <?php
              }
                ?>
                      </tr>
                     
                    </tbody>
                    </tbody>
                  </table>
                            <a
            class="btn btn-primary mt-3 w-15"
            href="tambahadmin.php">+ Tambah</a>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
             
      
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script>
</body>

</html>