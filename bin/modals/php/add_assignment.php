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

if(isset($_POST['office']) || isset($_POST['support_doc'])){

    $user = "Dhen";
        
    $time_zone = $_POST['timezone'];
    $set_zone = date_default_timezone_set($time_zone);
    $date_time = date('M-d-Y h:i:s a', time());

    $checked_array=$_POST['support_doc'];
    $office = pg_escape_string($_POST['office']);

    $get_off_name = "SELECT office FROM accsys.maintenance_get_docs WHERE offccode = '$office'";
    $get_off_result = pg_query($connection, $get_off_name);
    $off=pg_fetch_row($get_off_result);

    if(isset($checked_array)){

        foreach($_POST['support_doc_name'] as $key => $value)
        {
            if(in_array($_POST['support_doc_name'][$key], $checked_array)){
                
                $support_doc_name = $_POST['support_doc_name'][$key];
              
                $query = "INSERT INTO accsys.get_docs_office_setup (scode, offccode, office, trail)
                        VALUES ('$support_doc_name','$office', '".pg_escape_string($off[0])."', '--Added-- $user | $time_zone: $date_time | $ip')";
                
                $result = pg_query($connection, $query);
    
                if (pg_affected_rows($result) > 0){
                    $response['status'] = 1;
                }
                else{
                    $response['status'] = 2;
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