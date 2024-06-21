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

                $check_query = "SELECT * FROM accsys.maintenance_area_instrument_docs WHERE instrument_keyctr = '$ins_id' AND scode = '$doc[1]' AND offccode = '$doc[2]'";
                $check_result = pg_query($connection, $check_query);
?>
                <div class="pl-4 mb-2 item_cont">
                    <input class="form-check-input" type="checkbox" id="support_doc<?php echo $doc[0];?>" name="support_doc[]" value="<?php echo $doc[0];?>"
                    <?php
                        if(pg_num_rows($check_result) > 0){
                            echo "checked disabled";
                        }
                        else{
                            echo "";
                        }
                    ?>
                    >
                    <input type="hidden" name="office[]" id="office" value="<?php echo $doc[2];?>">
                    <input type="hidden" name="support_doc_name[]" id="support_doc_name" value="<?php echo $doc[0];?>">
                    <label class="form-check-label" for="support_doc<?php echo $doc[0];?>"><span class="text-secondary" style="font-weight: bold;"><?php echo $doc[4];?></span> | <?php echo $doc[3];?></label>
                </div>
<?php
            }
        }
        else{
            echo "No Supporting document(s) found.";
        }
    }
?>