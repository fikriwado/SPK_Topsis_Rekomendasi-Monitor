<?php
    require_once('init.php');

    if (!is_login()) {
        header('Location: login.php'); 
    }

    if (isset($_POST['btn-edit'])){
		require_once('koneksi.php');

        $id = $_POST['id'];
		$merk = $_POST['merk'];
		$tipe = $_POST['tipe'];
		$tipe_panel = $_POST['panel_type'];
		$harga = $_POST['price'];
		$ukuran_layar = $_POST['screen_size'];
		$response_time = $_POST['response_time'];
		$refresh_rate = $_POST['refresh_rate'];
		$resolusi = $_POST['resolution'];

		$sql    = "UPDATE
				        monitor
						    SET
							    merk = '$merk',
							    tipe = '$tipe',
								tipe_panel = '$tipe_panel',
								harga = $harga,
								ukuran_layar = $ukuran_layar,
                                response_time = $response_time,
								refresh_rate = $refresh_rate,
                                resolusi = '$resolusi'
                            WHERE 
                                id=".$id;
		echo $sql;
		$result = mysqli_query($koneksi,$sql);

        if ($result){
            header('Location: monitor.php');
        }
	}
?>