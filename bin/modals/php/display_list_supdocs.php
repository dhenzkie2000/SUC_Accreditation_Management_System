<?php

include_once '../../../connection/db_connect.php';

    if(isset($_POST['display'])){

        $office = $_POST['office'];

        $doc_query = "SELECT * FROM accsys.maintenance_supporting_docs ORDER BY scode ASC";
        $doc_result = pg_query($connection, $doc_query);
        if(pg_num_rows($doc_result) > 0){
            while($doc=pg_fetch_row($doc_result)){

                $check_query = "SELECT * FROM accsys.get_docs_office_setup WHERE scode = '$doc[0]' AND offccode = '$office'";
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
                    <input type="hidden" name="support_doc_name[]" id="support_doc_name" value="<?php echo $doc[0];?>">
                    <label class="form-check-label" for="support_doc<?php echo $doc[0];?>"><span class="text-secondary" style="font-weight: bold;"><?php echo $doc[1];?></span></label>
                </div>
<?php
            }
        }
        else{
            echo "No Supporting document(s) found.";
        }
    }
?>