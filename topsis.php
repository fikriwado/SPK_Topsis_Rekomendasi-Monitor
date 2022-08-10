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
                            <h1 class="h3 mb-4 text-gray-800">Masukan Bobot Kriteria</h1>
                        </div>
                    </div>


                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form method="POST" action="topsis_process.php">
                                        <div class="mb-3">
                                            <label for="panelType">Tipe Panel Layar</label><select class="form-control" id="panelType" name="panel_type">
                                                <option value="1">TFT</option>
                                                <option value="2">TN</option>
                                                <option value="3">VA</option>
                                                <option value="4">IPS</option>
                                                <option value="5">OLED</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price">Harga</label><select class="form-control" id="price" name="price">
                                                <option value="1">>= 3.500.000</option>
                                                <option value="2">3.000.000 - < 3.500.000</option>
                                                <option value="3">2.500.000 - < 3.000.000</option>
                                                <option value="4">1.500.000 - < 2.500.000</option>
                                                <option value="5">< 1.500.000</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="screenSize">Ukuran Layar</label><select class="form-control" id="screenSize" name="screen_size">
                                                <option value="1">< 19 inch</option>
                                                <option value="2">19 - 22 inch</option>
                                                <option value="3">22 - 24 inch</option>
                                                <option value="4">24 - 32 inch</option>
                                                <option value="5">>32 inch</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="refreshRate">Refresh Rate</label><select class="form-control" id="refreshRate" name="refresh_rate">
                                                <option value="1">< 60Hz</option>
                                                <option value="2">60Hz - 70Hz</option>
                                                <option value="3">70Hz - 144Hz</option>
                                                <option value="4">144Hz - 240Hz</option>
                                                <option value="5">>= 240Hz</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="responseTime">Response Time</label><select class="form-control" id="responseTime" name="response_time">
                                                <option value="1">>= 5ms</option>
                                                <option value="2">4ms</option>
                                                <option value="3">3ms</option>
                                                <option value="4">2ms</option>
                                                <option value="5"><= 1ms</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="resolution">Resolusi Layar</label><select class="form-control" id="resolution" name="resolution">
                                                <option value="1">SD</option>
                                                <option value="2">HD</option>
                                                <option value="3">FHD</option>
                                                <option value="4">QHD</option>
                                                <option value="5">UHD</option>
                                            </select>
                                        </div>
                                        <div class="mt-2">
                                            <button type="submit" name="btn-process" class="btn btn-primary">Proses</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>





                <?php @include('partials/footer.php'); ?>
            </div>
            <!-- End of Content Wrapper -->
        </div>

        <?php @include('partials/scroll-top-modal-logout.php'); ?>

        <!-- Bootstrap core JavaScript-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-Fy6S3B9q64WdZWQUiU+q4/2Lc9npb8tCaSX9FK7E8HnRr0Jz8D6OP9dO5Vg3Q9ct" crossorigin="anonymous"></script>

        <!-- Core plugin JavaScript-->
        <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-easing/1.4.1/jquery.easing.min.js" integrity="sha512-0QbL0ph8Tc8g5bLhfVzSqxe9GERORsKhIn1IrpxDAgUsbBGz/V7iSav2zzW325XGd1OMLdL4UiqRJj702IeqnQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>

        <!-- Custom scripts for all pages-->
        <script src="assets/js/sb-admin-2.min.js"></script>
</body>

</html>