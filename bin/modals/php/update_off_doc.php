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
        
        $ass_id = $_POST['ass_id'];

        $query = "SELECT keyctr, offccode, office FROM accsys.get_docs_office_setup WHERE keyctr = '$ass_id'";
        $result = pg_query($connection, $query);
        while($row = pg_fetch_assoc($result)){
            $data=$row;
        }
    }

    if($_POST['trig'] == '2'){

        if(!empty($_POST['up_office_id']) || !empty($_POST['up_supp_doc'])){
    
            $up_ass_id = $_POST['up_ass_id'];
            $up_office_id = pg_escape_string($_POST['up_office_id']);
            $up_office_name = pg_escape_string($_POST['up_office_name']);
            $up_supp_doc = pg_escape_string($_POST['up_supp_doc']);
    
            $check_query = "SELECT * FROM accsys.get_docs_office_setup WHERE offccode = '$up_office_id' AND scode = '$up_supp_doc'";
            $check_result = pg_query($connection, $check_query);
    
            if(pg_num_rows($check_result) > 0){
                $data['status'] = 2;
            }
            else{
                
                $user = "Dhen";
                $time_zone = $_POST['up_timezone'];
                $set_zone = date_default_timezone_set($time_zone);
                $date_time = date('M-d-Y h:i:s a', time());
    
                $up_query = "UPDATE accsys.get_docs_office_setup
                SET
                scode = '$up_supp_doc',
                offccode = '$up_office_id',
                office = '$up_office_name',
                trail = '--Updated-- $user | $time_zone: $date_time | $ip'
                WHERE keyctr = '$up_ass_id'";
    
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