<?php

    session_start();

    if($_POST['action'] == 'AddInstrument'){

        $param_id = $_POST['param_id'];
        $area_id = $_POST['area_id'];

        $_SESSION['param_id'] = $param_id;
        $_SESSION['area_id'] = $area_id;

        echo 'instrument.php';
    }
?>