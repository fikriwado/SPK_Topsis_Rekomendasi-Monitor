<?php
  require_once('init.php');

    if (!is_login()) {
        header('Location: login.php'); 
    }
    $merk = 0;
    $tipe;
    $tipe_panel;
    $harga;
    $ukuran_layar;
    $response_time;
    $refresh_rate;
    $resolusi;

	if (isset($_GET['id'])){
		require_once('koneksi.php');

		$sql    = "SELECT * FROM monitor WHERE id=".$_GET['id'];

        $result = mysqli_query($koneksi, $sql);
		$count 	= mysqli_num_rows($result);

        if($count > 0){
            while($data = $result->fetch_assoc()){
                $merk = $data['merk'];
                $tipe = $data['tipe'];
                $tipe_panel = $data['tipe_panel'];
                $harga = $data['harga'];
                $ukuran_layar = $data['ukuran_layar'];
                $response_time = $data['response_time'];
                $refresh_rate = $data['refresh_rate'];
                $resolusi = $data['resolusi'];
            }
        }else{
            header('Location: monitor.php');
        }
	}else{
        header('Location: monitor.php');
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
                            <h1 class="h3 mb-4 text-gray-800">Ubah Data Monitor</h1>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <form method="POST" action="monitor_edit_proc.php">
										<div class="mb-3">
                                            <label for="merk">Merk</label>
											<input class="form-control" id="merk" name="merk" type="text" value="<?=$merk;?>" required>
                                        </div>
										<div class="mb-3">
                                            <label for="tipe">Tipe</label>
											<input class="form-control" id="tipe" name="tipe" type="text" value="<?=$tipe;?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="panelType">Tipe Panel Layar</label><select class="form-control" id="panelType" name="panel_type">
                                                <option value="<?=$tipe_panel;?>"><?=$tipe_panel;?></option>
                                                <option value="TFT">TFT</option>
                                                <option value="TN">TN</option>
                                                <option value="VA">VA</option>
                                                <option value="IPS">IPS</option>
                                                <option value="OLED">OLED</option>
                                            </select>
                                        </div>
                                        <div class="mb-3">
                                            <label for="price">Harga</label>
											<input class="form-control" id="price" name="price" type="number" value="<?=$harga;?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="screenSize">Ukuran Layar</label>
                                            <input class="form-control" id="screenSize" name="screen_size" type="number" value="<?=$ukuran_layar;?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="refreshRate">Refresh Rate</label>
                                            <input class="form-control" id="refreshRate" name="refresh_rate" type="number" value="<?=$refresh_rate;?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="responseTime">Response Time</label>
                                            <input class="form-control" id="responseTime" name="response_time" type="number" value="<?=$response_time;?>" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="resolution">Resolusi Layar</label><select class="form-control" id="resolution" name="resolution">
                                                <option value="<?=$resolusi;?>"><?=$resolusi;?></option>
                                                <option value="1">SD</option>
                                                <option value="2">HD</option>
                                                <option value="3">FHD</option>
                                                <option value="4">QHD</option>
                                                <option value="5">UHD</option>
                                            </select>
                                        </div>
                                        <input type="hidden" name="id" value="<?=$_GET['id']?>">
                                        <div class="mt-2">
                                            <button type="submit" name="btn-edit" class="btn btn-primary">Simpan</button>
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