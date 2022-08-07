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
                                                        C3 (Cost)
                                                    </th>
                                                    <th>
                                                        C4 (Benefit)
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
                                                $query = mysqli_query($selectdb, "SELECT * FROM tbl_monitor");
                                                $no = 1;
                                                while ($data_hp = mysqli_fetch_array($query)) {
                                                    $Matrik[$no - 1] = array($data_hp['harga_angka'], $data_hp['ram_angka'], $data_hp['memori_angka'], $data_hp['processor_angka'], $data_hp['kamera_angka']);
                                                ?>
                                                    <tr>
                                                        <td>
                                                            <center><?php echo "A", $no ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $data_hp['harga_angka'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $data_hp['ram_angka'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $data_hp['memori_angka'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $data_hp['processor_angka'] ?></center>
                                                        </td>
                                                        <td>
                                                            <center><?php echo $data_hp['kamera_angka'] ?></center>
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