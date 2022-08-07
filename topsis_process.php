<?php
session_start();
include('koneksi.php');

//Bobot
$W1    = $_POST['refresh_rate'];
$W2    = $_POST['response_time'];
$W3    = $_POST['price'];
$W4    = $_POST['screen_size'];
$W5    = $_POST['panel_type'];
$W5    = $_POST['resolution'];


// Menentukan nilai bobot alternatif
function hitungBobot(Array $alternatif)
{
    $tipe_panel = $alternatif['tipe_panel'];
    $harga = $alternatif['harga'];
    $ukuran_layar = $alternatif['ukuran_layar'];
    $response_time = $alternatif['response_time'];
    $refresh_rate = $alternatif['refresh_rate'];
    $resolusi = $alternatif['resolusi'];

    $tipe_panel_angka = 0;
    $harga_angka =  0;
    $ukuran_layar_angka =  0;
    $response_time_angka =  0;
    $refresh_rate_angka = 0;
    $resolusi_angka =  0;

    if ($tipe_panel == 'TFT') {
        $tipe_panel_angka = 1;
    } else if ($tipe_panel == 'TN') {
        $tipe_panel_angka = 2;
    } else if ($tipe_panel == 'VA') {
        $tipe_panel_angka = 3;
    } else if ($tipe_panel == 'IPS') {
        $tipe_panel_angka = 4;
    } else if ($tipe_panel == 'OLED') {
        $tipe_panel_angka = 5;
    }

    if ($resolusi == 'SD') {
        $resolusi_angka = 1;
    } else if ($resolusi == 'HD') {
        $resolusi_angka = 2;
    } else if ($resolusi == 'FHD') {
        $resolusi_angka = 3;
    } else if ($resolusi == 'QHD') {
        $resolusi_angka = 4;
    } else if ($resolusi == 'UHD') {
        $resolusi_angka = 5;
    }


    if ($harga >= 3500000) {
        $harga_angka = 1;
    } else if ($harga >= 3000000 && $harga < 3500000) {
        $harga_angka = 2;
    } else if ($harga >= 2500000 && $harga < 3000000) {
        $harga_angka = 3;
    } else if ($harga >= 1500000 && $harga < 2500000) {
        $harga_angka = 4;
    } else if ($harga < 1500000) {
        $harga_angka = 5;
    }

    if ($ukuran_layar < 19) {
        $ukuran_layar_angka = 1;
    } else if ($ukuran_layar >= 19 && $ukuran_layar < 22) {
        $ukuran_layar_angka = 2;
    } else if ($ukuran_layar >= 22 && $ukuran_layar < 24) {
        $ukuran_layar_angka = 3;
    } else if ($ukuran_layar >= 24 && $ukuran_layar < 32) {
        $ukuran_layar_angka = 4;
    } else if ($ukuran_layar >= 32) {
        $ukuran_layar_angka = 5;
    }

    if ($refresh_rate < 60) {
        $refresh_rate_angka = 1;
    } else if ($refresh_rate >= 60 && $refresh_rate < 70) {
        $refresh_rate_angka = 2;
    } else if ($refresh_rate >= 70 && $refresh_rate < 144) {
        $refresh_rate_angka = 3;
    } else if ($refresh_rate >= 144 && $refresh_rate < 240) {
        $refresh_rate_angka = 4;
    } else if ($refresh_rate >= 240) {
        $refresh_rate_angka = 5;
    }

    if ($response_time >= 5) {
        $response_time_angka = 1;
    } else if ($response_time > 3 && $response_time <= 4) {
        $response_time_angka = 2;
    } else if ($response_time > 2 && $response_time <= 3) {
        $response_time_angka = 3;
    } else if ($response_time > 1 && $response_time <= 2) {
        $response_time_angka = 4;
    } else if ($response_time <= 1) {
        $response_time_angka = 5;
    }


    return array($tipe_panel_angka, $harga_angka, $ukuran_layar_angka, $refresh_rate_angka, $response_time_angka, $resolusi_angka);
}

// Mencari Nilai Pembagi
function calculateDividerValue($matrix)
{
    for ($i = 0; $i < 6; $i++) {
        $pangkatdua[$i] = 0;
        for ($j = 0; $j < sizeof($matrix); $j++) {
            $pangkatdua[$i] = $pangkatdua[$i] + pow($matrix[$j][$i], 2);
        }
        $dividers[$i] = sqrt($pangkatdua[$i]);
    }
    return $dividers;
}

// Fungsi Untuk normalisasi
function Transpose($squareArray)
{

    if ($squareArray == null) {
        return null;
    }
    $rotatedArray = array();
    $r = 0;

    foreach ($squareArray as $row) {
        $c = 0;
        if (is_array($row)) {
            foreach ($row as $cell) {
                $rotatedArray[$c][$r] = $cell;
                ++$c;
            }
        } else $rotatedArray[$c][$r] = $row;
        ++$r;
    }
    return $rotatedArray;
}

// Mencari nilai solusi ideal
function JarakIplus($aplus, $bob)
{
    for ($i = 0; $i < sizeof($bob); $i++) {
        $dplus[$i] = 0;
        for ($j = 0; $j < sizeof($aplus); $j++) {
            $dplus[$i] = $dplus[$i] + pow(($aplus[$j] - $bob[$i][$j]), 2);
        }
        $dplus[$i] = round(sqrt($dplus[$i]), 4);
    }
    return $dplus;
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
                                <div class="card-header">
                                   Matrik Data Monitor
                                </div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">

                                            <thead style="border-top: 1px solid #d0d0d0;">
                                                <tr>
                                                    <th>
                                                        Alternatif
                                                    </th>
                                                    <th>
                                                        C1 (Benefit)
                                                    </th>
                                                    <th>
                                                        C2 (Cost)
                                                    </th>
                                                    <th>
                                                        C3 (Benefit)
                                                    </th>
                                                    <th>
                                                        C4 (Cost)
                                                    </th>
                                                    <th>
                                                        C5 (Benefit)
                                                    </th>
                                                    <th>
                                                        C6 (Benefit)
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT * FROM monitor");
                                                $no = 1;
                                                while ($data = mysqli_fetch_array($query)) {
                                                    $nilaiBobot = hitungBobot($data);
                                                    $Matrik[$no - 1] = $nilaiBobot;
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo "A", $no ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $nilaiBobot[0] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $nilaiBobot[1] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $nilaiBobot[2] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $nilaiBobot[3] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $nilaiBobot[4] ?>
                                                        </td>
                                                        <td>
                                                            <?php echo $nilaiBobot[5] ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card shadow mb-4">
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <?php 
                                                $pembagiNM = calculateDividerValue($Matrik);
                                            ?>
                                            <thead style="border-top: 1px solid #d0d0d0;">
                                                <tr>
                                                    <th>
                                                        Nilai Pembagi
                                                    </th>
                                                    <th>
                                                        <?= round($pembagiNM[0], 6) ?>
                                                    </th>
                                                    <th>
                                                        <?= round($pembagiNM[1], 6) ?>
                                                    </th>
                                                    <th>
                                                        <?= round($pembagiNM[2], 6) ?>
                                                    </th>
                                                    <th>
                                                        <?= round($pembagiNM[3], 6) ?>
                                                    </th>
                                                    <th>
                                                        <?= round($pembagiNM[4], 6) ?>
                                                    </th>
                                                    <th>
                                                        <?= round($pembagiNM[5], 6) ?>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th>
                                                        Alternatif
                                                    </th>
                                                    <th>
                                                        C1 (Benefit)
                                                    </th>
                                                    <th>
                                                        C2 (Cost)
                                                    </th>
                                                    <th>
                                                        C3 (Benefit)
                                                    </th>
                                                    <th>
                                                        C4 (Cost)
                                                    </th>
                                                    <th>
                                                        C5 (Benefit)
                                                    </th>
                                                    <th>
                                                        C6 (Benefit)
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT * FROM monitor");
                                                $no = 1;
                                                while ($data = mysqli_fetch_array($query)) {

                                                    $nilaiBobotAlternatif = hitungBobot($data);
                                                    $nilai1 = $nilaiBobotAlternatif[0] / $pembagiNM[0];
                                                    $nilai2 = $nilaiBobotAlternatif[1] / $pembagiNM[1];
                                                    $nilai3 = $nilaiBobotAlternatif[2] / $pembagiNM[2];
                                                    $nilai4 = $nilaiBobotAlternatif[3] / $pembagiNM[3];
                                                    $nilai5 = $nilaiBobotAlternatif[4] / $pembagiNM[4];
                                                    $nilai6 = $nilaiBobotAlternatif[5] / $pembagiNM[5];
                                                    $MatrikNormalisasi[$no - 1] = array($nilai1, $nilai2, $nilai3, $nilai4, $nilai5, $nilai6);

                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?php echo "A", $no ?>
                                                        </td>
                                                        <td>
                                                            <?php echo round($nilai1, 6) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo round($nilai2, 6) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo round($nilai3, 6) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo round($nilai4, 6) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo round($nilai5, 6) ?>
                                                        </td>
                                                        <td>
                                                            <?php echo round($nilai6, 6) ?>
                                                        </td>
                                                    </tr>
                                                <?php
                                                    $no++;
                                                }
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>
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