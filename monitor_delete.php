<?php
    require_once('init.php');

    if (!is_login()) {
        header('Location: login.php'); 
    }

    if (isset($_POST['delete'])){
        require_once('koneksi.php');
        echo $_POST['delete'];

        $sql = "DELETE FROM monitor WHERE id=".$_POST['delete'];

        $result = mysqli_query($koneksi,$sql);

        if ($result){
            header('Location: monitor.php');
        }
    }else{
        header('Location: monitor.php');
    }
?>