<?php
include_once '../../../connection/db_connect.php';

$data=array();

if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else{
    $ip=$_SERVER['REMOTE_ADDR'];
}

if($_POST['trig'] == '1'){
    
    $area_id = $_POST['area_id'];

    $query = "SELECT keyctr, short_def, description FROM accsys.maintenance_area WHERE keyctr = $area_id";
    $result = pg_query($connection, $query);
    while($row = pg_fetch_assoc($result)){
        $data=$row;
    }
}

if($_POST['trig'] == '2'){

    if(!empty($_POST['up_area_def'])){

        $up_area_id = $_POST['up_area_id'];
        $up_area_def = strtoupper(pg_escape_string($_POST['up_area_def']));
        $up_area_desc = strtoupper(pg_escape_string($_POST['up_area_desc']));

        $check_query = "SELECT * FROM accsys.maintenance_area WHERE short_def = '$up_area_def'";
        $check_result = pg_query($connection, $check_query);

        if(pg_num_rows($check_result) > 0){
            $data['status'] = 2;
        }
        else{
            
            $user = "Dhen";
            $time_zone = $_POST['up_timezone'];
            $set_zone = date_default_timezone_set($time_zone);
            $date_time = date('M-d-Y h:i:s a', time());

            $up_query = "UPDATE accsys.maintenance_area
            SET
            short_def = '$up_area_def',
            description = '$up_area_desc',
            trail = '--Updated-- $user | $time_zone: $date_time | $ip'
            WHERE keyctr = $up_area_id";

            $up_result = pg_query($connection, $up_query);

            if(pg_affected_rows($up_result) > 0){
                $data['status'] = 1;
            }
            else{
                $data['status'] = 3;
            }
        }

    }
    else{
        $data['status'] = 0;
    }
}

echo json_encode($data);
?>