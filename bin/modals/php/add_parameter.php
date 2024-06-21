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

if(isset($_POST['add_param_def'])){

        $user = "Dhen";
        
        $time_zone = $_POST['add_timezone'];
        $set_zone = date_default_timezone_set($time_zone);
        $date_time = date('M-d-Y h:i:s a', time());
        
        $add_param_code = strtoupper($_POST['add_param_code']);
        $add_param_def = strtoupper(pg_escape_string($_POST['add_param_def']));
        $add_param_desc = strtoupper(pg_escape_string($_POST['add_param_desc']));
        $add_area_id = $_POST['add_area_id'];
        

        if(!empty($add_param_def) || !empty($add_param_code)){

            $check_off = "SELECT * FROM accsys.maintenance_area_parameter WHERE param_code = '".$add_area_id."".$add_param_code."'";
            $check_result = pg_query($connection, $check_off);

            if(pg_num_rows($check_result) > 0){
                $response['status'] = 2;
            }
            else{
                $query = "INSERT INTO accsys.maintenance_area_parameter (param_code, area_code, short_def, description, trail)
                VALUES ('".$add_area_id."".$add_param_code."','$add_area_id', '$add_param_def', '$add_param_desc', '--Added-- $user | $time_zone: $date_time | $ip')";
                
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