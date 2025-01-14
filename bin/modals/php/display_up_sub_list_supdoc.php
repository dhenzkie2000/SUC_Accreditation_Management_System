<?php

include_once '../../../connection/db_connect.php';

    if(isset($_POST['display'])){

        $ins_id = $_POST['ins_id'];

        $doc_query = "SELECT accsys.get_docs_office_setup.keyctr, accsys.get_docs_office_setup.scode, accsys.get_docs_office_setup.offccode,
        accsys.get_docs_office_setup.office, accsys.maintenance_supporting_docs.support_document
        FROM accsys.get_docs_office_setup
        INNER JOIN accsys.maintenance_supporting_docs
        ON accsys.get_docs_office_setup.scode = accsys.maintenance_supporting_docs.scode
        ORDER BY accsys.get_docs_office_setup.scode ASC";
        $doc_result = pg_query($connection, $doc_query);
        if(pg_num_rows($doc_result) > 0){
            while($doc=pg_fetch_row($doc_result)){

                $check_query = "SELECT * FROM accsys.maintenance_area_instrument_sub_docs WHERE instrument_sub_keyctr = '$ins_id' AND scode = '$doc[1]' AND offccode = '$doc[2]'";
                $check_result = pg_query($connection, $check_query);
?>
                <div class="pl-4 mb-2 item_cont">
<?php
                        if(pg_num_rows($check_result) > 0){
?>
                            <span id="uncheck_sub_supdoc" style="margin-left:-20px; cursor:default" ins-id="<?php echo $ins_id;?>" scode="<?php echo $doc[1];?>" offccode="<?php echo $doc[2];?>">
                                <i class="fa fa-times-circle text-danger"></i>
                                <span class="text-secondary" style="font-weight: bold;"><?php echo $doc[4];?></span> | <?php echo $doc[3];?>
                            </span>
<?php
                        }
                        else{
?>
                            <input class="form-check-input" type="checkbox" id="up_sub_support_doc<?php echo $doc[0];?>" name="support_doc[]" value="<?php echo $doc[0];?>">
                            <label class="form-check-label" for="up_sub_support_doc<?php echo $doc[0];?>"><span class="text-secondary" style="font-weight: bold;"><?php echo $doc[4];?></span> | <?php echo $doc[3];?></label>
<?php
                        }
                    ?>
                    <input type="hidden" name="office[]" id="up_sub_office" value="<?php echo $doc[2];?>">
                    <input type="hidden" name="support_doc_name[]" id="up_sub_support_doc_name" value="<?php echo $doc[0];?>">
                </div>
<?php
            }
        }
        else{
            echo "No Supporting document(s) found.";
        }
    }
?>