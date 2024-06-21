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

if(isset($_POST['cat_code'])){

        $user = "Dhen";
        
        $time_zone = $_POST['timezone'];
        $set_zone = date_default_timezone_set($time_zone);
        $date_time = date('M-d-Y h:i:s a', time());
        
        $cat_code = strtoupper($_POST['cat_code']);
        $cat_desc = strtoupper(pg_escape_string($_POST['cat_desc']));
        $cat_plac = pg_escape_string($_POST['cat_plac']);

        if(!empty($cat_code) && !empty($cat_plac)){

            $check_cat = "SELECT * FROM accsys.maintenance_parameter_category WHERE cat_code = '$cat_code'";
            $check_result = pg_query($connection, $check_cat);

            if(pg_num_rows($check_result) > 0){
                $response['status'] = 2;
            }
            else{

                $placement = "SELECT * FROM accsys.maintenance_parameter_category WHERE order_num = '$cat_plac'";
                $plac_result = pg_query($connection, $placement);

                if(pg_num_rows($plac_result) > 0){
                    $response['status'] = 3;
                }
                else{

                    $query = "INSERT INTO accsys.maintenance_parameter_category (cat_code, description, trail, order_num)
                    VALUES ('$cat_code','$cat_desc', '--Added-- $user | $time_zone: $date_time | $ip', $cat_plac)";
                    
                    $result = pg_query($connection, $query);
        
                    if (pg_affected_rows($result) > 0){
                        $response['status'] = 1;
                    }
                    else{
                        $response['status'] = 4;
                    }

                }
            } 
        }
        else{
            $response['status'] = 0;  
        }
}

echo json_encode($response);
?>