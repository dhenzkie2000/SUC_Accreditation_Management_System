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

if(isset($_POST['off_code'])){

        $user = "Dhen";
        
        $time_zone = $_POST['timezone'];
        $set_zone = date_default_timezone_set($time_zone);
        $date_time = date('M-d-Y h:i:s a', time());
        
        $off_code = $_POST['off_code'];
        $off_name = pg_escape_string($_POST['off_name']);

        if(!empty($off_code)){

            $check_off = "SELECT * FROM accsys.maintenance_get_docs WHERE offccode = '$off_code' OR office = '$off_name'";
            $check_result = pg_query($connection, $check_off);

            if(pg_num_rows($check_result) > 0){
                $response['status'] = 2;
            }
            else{
                $query = "INSERT INTO accsys.maintenance_get_docs (offccode, office, trail)
                VALUES ('$off_code','$off_name', '--Added-- $user | $time_zone: $date_time | $ip')";
                
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