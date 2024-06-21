<?php

include_once '../../../connection/db_connect.php';

$response = array(
    'status' => 0,
);

if(!empty($_SERVER['HTTP_CLIENT_IP'])){
    $ip=$_SERVER['HTTP_CLIENT_IP'];
}
elseif(!empty($_SERVER['HTTP_X_FORWARDED_FOR'])){
    $ip=$_SERVER['HTTP_X_FORWARDED_FOR'];
}
else{
    $ip=$_SERVER['REMOTE_ADDR'];
}

if(isset($_POST['area_def'])){

        $user = "Dhen";
        
        $time_zone = $_POST['timezone'];
        $set_zone = date_default_timezone_set($time_zone);
        $date_time = date('M-d-Y h:i:s a', time());
        
        $area_def = strtoupper(pg_escape_string($_POST['area_def']));
        $area_desc = pg_escape_string($_POST['area_desc']);

        if(!empty($_POST['area_def'])){

            $check_area = "SELECT * FROM accsys.maintenance_area WHERE short_def = '$area_def'";
            $check_result = pg_query($connection, $check_area);

            if(pg_num_rows($check_result) > 0){
                $response['status'] = 2;
            }
            else{
                $query = "INSERT INTO accsys.maintenance_area (short_def, description, trail)
                VALUES ('$area_def', '$area_desc', '--Added-- $user | $time_zone: $date_time | $ip')";
                
                $result = pg_query($connection, $query);
    
                if (pg_affected_rows($result) > 0){
                    $response['status'] = 1;
                }
                else{
                    $response['status'] = 3;
                }
            } 
        }
        else{
            $response['status'] = 0;  
        }
}

echo json_encode($response);
?>