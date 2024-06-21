<?php
include_once '../../../connection/db_connect.php';

if(isset($_POST['display'])){

    $office_id = $_POST['office_id'];
    $doc_id = $_POST['doc_id'];

    $get_doc_name = "SELECT * FROM accsys.maintenance_supporting_docs WHERE scode = '$doc_id'";
    $get_doc_name_r = pg_query($connection, $get_doc_name);
    $doc_name=pg_fetch_row($get_doc_name_r);
?>
            <option hidden><?php echo $doc_name[1]?></option>
<?php
            $get_sup_doc = "SELECT * FROM accsys.maintenance_supporting_docs ORDER BY scode ASC";
            $get_sup_doc_r = pg_query($connection, $get_sup_doc);
            if(pg_num_rows($get_sup_doc_r) > 0){
                while($supp_doc=pg_fetch_row($get_sup_doc_r)){

                    $check = "SELECT * FROM accsys.get_docs_office_setup WHERE offccode = '$office_id' AND scode = '$supp_doc[0]'";
                    $check_r = pg_query($connection, $check);

                    if(pg_num_rows($check_r) > 0){
?>
                        <option style="background-color: #eaecf4;" disabled><?php echo $supp_doc[1];?></option>    
<?php
                    }
                    else{
?>
                        <option value="<?php echo $supp_doc[0];?>"><?php echo $supp_doc[1];?></option>               
<?php
                    }
                }
            }
            else{
                echo "No Supporting document(s) found.";
            }
}
?>