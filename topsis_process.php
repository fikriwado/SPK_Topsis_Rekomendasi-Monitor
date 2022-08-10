<?php

require_once('init.php');

if (!is_login()) {
    header('Location: login.php');
}

include('koneksi.php');

//Bobot
$W1    = $_POST['panel_type'];
$W2    = $_POST['price'];
$W3    = $_POST['screen_size'];
$W4    = $_POST['refresh_rate'];
$W5    = $_POST['response_time'];
$W6    = $_POST['resolution'];


// Menentukan nilai bobot alternatif
function hitungBobot(array $alternatif)
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
                            <h1 class="h3 mb-4 text-gray-800">Hasil Perhitungan Dengan Metode Topsis</h1>
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
                                <div class="card-header">Matrik Ternormalisasi</div>
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

                    <div class="row">
                        <div class="col-lg-10">
                            <div class="card shadow mb-4">
                                <div class="card-header">Bobot (W)</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead>
                                                <tr>
                                                    <th>
                                                        (W) Tipe Panel
                                                    </th>
                                                    <th>
                                                        (W) Harga
                                                    </th>
                                                    <th>
                                                        (W) Ukuran Layar
                                                    </th>
                                                    <th>
                                                        (W) Refresh Rate
                                                    </th>
                                                    <th>
                                                        (W) Response Time
                                                    </th>
                                                    <th>
                                                        (W) Resolusi
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <!--count($W)-->
                                                <tr>
                                                    <td>
                                                        <?php echo ($W1); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($W2); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($W3); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($W4); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($W5); ?>
                                                    </td>
                                                    <td>
                                                        <?php echo ($W6); ?>
                                                    </td>
                                                </tr>
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
                                <div class="card-header">Matriks Normalisasi terBobot "Y"</div>
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

                                                    $NormalisasiBobot[$no - 1] = array(
                                                        $MatrikNormalisasi[$no - 1][0] * $W1,
                                                        $MatrikNormalisasi[$no - 1][1] * $W2,
                                                        $MatrikNormalisasi[$no - 1][2] * $W3,
                                                        $MatrikNormalisasi[$no - 1][3] * $W4,
                                                        $MatrikNormalisasi[$no - 1][4] * $W5,
                                                        $MatrikNormalisasi[$no - 1][5] * $W6
                                                    );

                                                ?>
                                                    <tr>
                                                        <td>
                                                            <?= "A", $no ?>
                                                        </td>
                                                        <td>
                                                            <?= round($MatrikNormalisasi[$no - 1][0] * $W1, 6) ?>
                                                        </td>
                                                        <td>
                                                            <?= round($MatrikNormalisasi[$no - 1][1] * $W2, 6) ?>
                                                        </td>
                                                        <td>
                                                            <?= round($MatrikNormalisasi[$no - 1][2] * $W3, 6) ?>
                                                        </td>
                                                        <td>
                                                            <?= round($MatrikNormalisasi[$no - 1][3] * $W4, 6) ?>
                                                        </td>
                                                        <td>
                                                            <?= round($MatrikNormalisasi[$no - 1][4] * $W5, 6) ?>
                                                        </td>
                                                        <td>
                                                            <?= round($MatrikNormalisasi[$no - 1][5] * $W5, 6) ?>
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
                                <div class="card-header">Matrik Solusi ideal positif "A+" dan negatif "A-"</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead style="border-top: 1px solid #d0d0d0;">
                                                <tr>
                                                    <th>

                                                    </th>
                                                    <th>
                                                        Y1 (Benefit)
                                                    </th>
                                                    <th>
                                                        Y2 (Cost)
                                                    </th>
                                                    <th>
                                                        Y3 (Benefit)
                                                    </th>
                                                    <th>
                                                        Y4 (Cost)
                                                    </th>
                                                    <th>
                                                        Y5 (Benefit)
                                                    </th>
                                                    <th>
                                                        Y6 (Benefit)
                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $NormalisasiBobotTrans = Transpose($NormalisasiBobot);
                                                ?>
                                                <tr>
                                                    <?php
                                                    $solusiIdeal1 = max($NormalisasiBobotTrans[0]);
                                                    $solusiIdeal2 = min($NormalisasiBobotTrans[1]);
                                                    $solusiIdeal3 = max($NormalisasiBobotTrans[2]);
                                                    $solusiIdeal4 = min($NormalisasiBobotTrans[3]);
                                                    $solusiIdeal5 = max($NormalisasiBobotTrans[4]);
                                                    $solusiIdeal6 = max($NormalisasiBobotTrans[5]);
                                                    $idealpositif = array($solusiIdeal1, $solusiIdeal2, $solusiIdeal3, $solusiIdeal4, $solusiIdeal5, $solusiIdeal6);
                                                    ?>
                                                    <td>
                                                        <?= "Y+" ?>
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal1, 6)); ?>&nbsp(max)
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal2, 6)); ?>&nbsp(min)
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal3, 6)); ?>&nbsp(max)
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal4, 6)); ?>&nbsp(min)
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal5, 6)); ?>&nbsp(max)
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal6, 6)); ?>&nbsp(max)
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php
                                                    $solusiIdeal1 = min($NormalisasiBobotTrans[0]);
                                                    $solusiIdeal2 = max($NormalisasiBobotTrans[1]);
                                                    $solusiIdeal3 = min($NormalisasiBobotTrans[2]);
                                                    $solusiIdeal4 = max($NormalisasiBobotTrans[3]);
                                                    $solusiIdeal5 = min($NormalisasiBobotTrans[4]);
                                                    $solusiIdeal6 = min($NormalisasiBobotTrans[5]);
                                                    $idealnegatif = array($solusiIdeal1, $solusiIdeal2, $solusiIdeal3, $solusiIdeal4, $solusiIdeal5, $solusiIdeal6);
                                                    ?>
                                                    <td>
                                                        <?= "Y-" ?>
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal1, 6)); ?>&nbsp(min)
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal2, 6)); ?>&nbsp(max)
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal3, 6)); ?>&nbsp(min)
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal4, 6)); ?>&nbsp(max)
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal5, 6)); ?>&nbsp(min)
                                                    </td>
                                                    <td>
                                                        <?= (round($solusiIdeal6, 6)); ?>&nbsp(min)
                                                    </td>
                                                </tr>
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
                                <div class="card-header">Jarak antara nilai terbobot setiap alternatif terhadap solusi ideal positif</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead style="border-top: 1px solid #d0d0d0;">
                                                <tr>
                                                    <th colspan="2">D+</th>
                                                    <th colspan="2">D-</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT * FROM monitor");
                                                $no = 1;
                                                $Dplus = JarakIplus($idealpositif, $NormalisasiBobot);
                                                $Dmin = JarakIplus($idealnegatif, $NormalisasiBobot);
                                                while ($data = mysqli_fetch_array($query)) {

                                                ?>
                                                    <tr>
                                                        <td><?php echo "D", $no ?></td>
                                                        <td><?php echo round($Dplus[$no - 1], 6) ?></td>
                                                        <td><?php echo "D", $no ?></td>
                                                        <td><?php echo round($Dmin[$no - 1], 6) ?></td>
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
                                <div class="card-header">Nilai Preferensi untuk Setiap alternatif (V)</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead style="border-top: 1px solid #d0d0d0;">
                                                <tr>
                                                    <th>Nilai Preferensi "V"</th>
                                                    <th>Nilai</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $query = mysqli_query($koneksi, "SELECT * FROM monitor");
                                                $no = 1;
                                                $nilaiV = array();
                                                while ($data = mysqli_fetch_array($query)) {

                                                    array_push($nilaiV, $Dmin[$no - 1] / ($Dmin[$no - 1] + $Dplus[$no - 1]));
                                                ?>
                                                    <tr>
                                                        <td><?php echo "V", $no ?></td>
                                                        <td><?php echo $Dmin[$no - 1] / ($Dmin[$no - 1] + $Dplus[$no - 1]); ?></td>
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
                                <div class="card-header">Nilai Preferensi tertinggi</div>
                                <div class="card-body">
                                    <div class="table-responsive">
                                        <table class="table">
                                            <thead style="border-top: 1px solid #d0d0d0;">
													<tr>
														<th>Nilai Preferensi tertinggi</th>
														<th></th>
														<th>Alternatif Tipe Monitor terpilih</th>
													</tr>
												</thead>
												<tbody>
													<tr>
														<?php
														$testmax = max($nilaiV);
														for ($i=0; $i < count($nilaiV); $i++) { 
															if ($nilaiV[$i] == $testmax) {
																$query=mysqli_query($koneksi,"SELECT * FROM monitor where id = $i+1");
																?>
																<td><?php echo "V".($i+1); ?></td>
																<td><?php echo $nilaiV[$i]; ?></td>
																<?php while ($data=mysqli_fetch_array($query)) { ?>
																<td><?php echo $data['tipe']; ?></td>
																<?php
															}
														}
													} ?>
												</tr>
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