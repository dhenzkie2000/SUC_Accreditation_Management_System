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

if(isset($_POST['lvl_num'])){

        $user = "Dhen";
        
        $time_zone = $_POST['timezone'];
        $set_zone = date_default_timezone_set($time_zone);
        $date_time = date('M-d-Y h:i:s a', time());
        
        $lvl_num = $_POST['lvl_num'];
        $lvl_description = pg_escape_string($_POST['lvl_desc']);

        if(!empty($lvl_num)){

            $check_lvl = "SELECT lvl_code FROM accsys.maintenance_level WHERE lvl_code = '$lvl_num'";
            $check_result = pg_query($connection, $check_lvl);

            if(pg_num_rows($check_result) > 0){
                $response['status'] = 2;
            }
            else{
                $query = "INSERT INTO accsys.maintenance_level (lvl_code, description, trail)
                VALUES ($lvl_num,'$lvl_description', '--Added-- $user | $time_zone: $date_time | $ip')";
                
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