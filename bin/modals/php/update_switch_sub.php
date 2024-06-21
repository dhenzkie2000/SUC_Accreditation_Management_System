<?php
include_once '../../../connection/db_connect.php';

if(isset($_POST['ins_id'])){
    
    $ins_id = $_POST['ins_id'];

    $check_stat = "SELECT sub_instrument FROM accsys.maintenance_area_instrument WHERE keyctr='$ins_id'";
    $check_result = pg_query($connection, $check_stat);
    $stat=pg_fetch_row($check_result);

    if($stat[0] == 't'){
        $query = "UPDATE accsys.maintenance_area_instrument
        SET
        sub_instrument = 'f'
        WHERE keyctr = '$ins_id'";

        $result = pg_query($connection, $query);
    }
    elseif($stat[0] == 'f'){
        $query = "UPDATE accsys.maintenance_area_instrument
        SET
        sub_instrument = 't'
        WHERE keyctr = '$ins_id'";

        $result = pg_query($connection, $query);
    }
}
?>