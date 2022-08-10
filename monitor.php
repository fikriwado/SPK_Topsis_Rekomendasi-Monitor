<?php
  require_once('init.php');

  if (!is_login()) {
    header('Location: login.php'); 
  }

  require_once('koneksi.php');
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <?php @include('partials/head.php'); ?>
		<script src="https://unpkg.com/feather-icons"></script>
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
                <h1 class="h3 mb-4 text-gray-800">Monitor</h1>
              </div>
            </div>

            <div class="row">
              <div class="col-lg-10">
                <div class="card shadow mb-4">
                  <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                      Data Monitor
                    </h6>
                  </div>
                  <div class="card-body">
                    <a href="monitor_add.php">
                      <button class="btn btn-primary btn-icon right" type="button">
											  Tambah Monitor
                      </button>
                    </a>
                    <br><br>
                    <table class="table table-bordered text-center">
                      <thead>
                        <tr>
                          <th scope="col" width="8%" class="text-left">ID</th>
                          <th scope="col" width="8%">MERK</th>
                          <th scope="col" width="8%">TIPE</th>
                          <th scope="col" width="8%">TIPE LAYAR</th>
                          <th scope="col" width="8%">HARGA</th>
                          <th scope="col" width="8%">UKURAN LAYAR</th>
                          <th scope="col" width="8%">RESPONSE TIME</th>
                          <th scope="col" width="8%">REFRESH RATE</th>
                          <th scope="col" width="8%">RESOLUSI</th>
													<th width="28%">ACTION</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                            $sql    = "SELECT * FROM monitor";
                            $result = mysqli_query(
															$koneksi,
															$sql
														);

														while($data = $result->fetch_assoc()) {
															echo "
																<tr>
																		<th scope='row' class='text-left'>".$data['id']."</th>
																		<td>".$data['merk']."</td>
																		<td>".$data['tipe']."</td>
																		<td>".$data['tipe_panel']."</td>
																		<td>".$data['harga']."</td>
																		<td>".$data['ukuran_layar']."</td>
																		<td>".$data['response_time']."</td>
																		<td>".$data['refresh_rate']."</td>
																		<td>".$data['resolusi']."</td>";?>
																		<td>
																			<a href="monitor_edit.php?id=<?=$data['id'];?>"><button class="btn btn-primary btn-icon" type="submit" name="edit" value="<?=$data['id'];?>">
																			<i class="fas fa-edit"></i></button>
                                      <form id="sendIdDelete" action="monitor_delete.php" method="post">
                                        <button onclick="confirmAction()" class="btn btn-danger btn-icon" type="submit" name="delete" value="<?=$data['id'];?>">
                                        <i class="fas fa-trash"></i></button>
                                      </form>
																		</td>
																</tr><?php
                              ;
														}
                            
                        ?>
                        
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
    <script>
      // The function below will start the confirmation dialog
      function confirmAction() {
        let confirmAction = confirm("Apakah Anda yakin akan menghapus data?");
        if (confirmAction) {
          document.getElementById("sendIdDelete").submit();
        }
      }
    </script>
  </body>
</html>
