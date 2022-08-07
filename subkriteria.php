<?php
	require_once('init.php');

  if (!is_login()) {
    header('Location: login.php');
  }
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php @include('partials/head.php'); ?>
  </head>

  <body id="page-top">
    <div id="wrapper">
      <?php @include('partials/sidebar.php'); ?>

      <!-- Content Wrapper -->
      <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
        <div id="content">
          <?php @include('partials/topbar.php'); ?>
          
          <!-- Begin Page Content -->
          <div class="container-fluid">
            <div class="row">
              <div class="col">
                <h1 class="h3 mb-4 text-gray-800">Subkriteria</h1>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-10">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                      Data Subkriteria
                    </h6>
                  </div>
                  <div class="card-body">
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                          <th scope="col">BOBOT</th>
                          <th scope="col">REFRESH RATE</th>
                          <th scope="col">RESPONSE TIME</th>
                          <th scope="col">HARGA</th>
                          <th scope="col">UKURAN LAYAR</th>
                          <th scope="col">TIPE LAYAR</th>
                          <th scope="col">RESOLUSI</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td>1</td>
                          <td>&lt; 60Hz</td>
                          <td>5</td>
                          <td>&gt;= 3.500.000</td>
                          <td>&lt; 19"</td>
                          <td>TFT</td>
                          <td>SD</td>
                        </tr>
                        <tr>
                          <td>2</td>
                          <td>60Hz - 70Hz</td>
                          <td>4</td>
                          <td>3.000.000 - &lt; 3.500.000</td>
                          <td>19" - 22"</td>
                          <td>TN</td>
                          <td>HD</td>
                        </tr>
                        <tr>
                          <td>3</td>
                          <td>70Hz - 144Hz</td>
                          <td>3</td>
                          <td>2.500.000 - &lt; 3.000.000</td>
                          <td>22" - 24"</td>
                          <td>VA</td>
                          <td>FHD</td>
                        </tr>
                        <tr>
                          <td>4</td>
                          <td>144Hz - 240Hz</td>
                          <td>2</td>
                          <td>1.500.000 - &lt; 2.500.000</td>
                          <td>24" - 32"</td>
                          <td>IPS</td>
                          <td>QHD</td>
                        </tr>
                        <tr>
                          <td>5</td>
                          <td>&gt;= 240Hz</td>
                          <td>&lt;= 1</td>
                          <td>&lt; 1.500.000</td>
                          <td>&gt;32"</td>
                          <td>OLED</td>
                          <td>UHD</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- /.container-fluid -->
        </div>
        <!-- End of Main Content -->

        <?php @include('partials/footer.php'); ?>
      </div>
      <!-- End of Content Wrapper -->
    </div>

    <?php @include('partials/scroll-top-modal-logout.php'); ?>

    <!-- Bootstrap core JavaScript-->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
      integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct"
      crossorigin="anonymous"
    ></script>

    <!-- Core plugin JavaScript-->
    <script
      src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js"
      integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ=="
      crossorigin="anonymous"
      referrerpolicy="no-referrer"
    ></script>

    <!-- Custom scripts for all pages-->
    <script src="assets/js/sb-admin-2.min.js"></script>
  </body>
</html>
