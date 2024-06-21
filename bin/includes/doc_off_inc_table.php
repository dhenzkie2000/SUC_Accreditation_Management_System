                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>Support Document</th>
                                    <th>Office</th>
                                    <th>Trail</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>Support Document</th>
                                    <th>Office</th>
                                    <th>Trail</th>
                                    <th>Action</th>
                                </tr>
                            </tfoot>
                            <tbody>
<?php
                            $query = "SELECT accsys.get_docs_office_setup.keyctr, accsys.get_docs_office_setup.trail, accsys.maintenance_supporting_docs.scode ,accsys.maintenance_supporting_docs.support_document, accsys.maintenance_get_docs.office
                            FROM accsys.get_docs_office_setup
                            INNER JOIN accsys.maintenance_supporting_docs
                            ON accsys.maintenance_supporting_docs.scode = accsys.get_docs_office_setup.scode
                            INNER JOIN accsys.maintenance_get_docs
                            ON accsys.maintenance_get_docs.offccode = accsys.get_docs_office_setup.offccode
                            ORDER BY accsys.get_docs_office_setup.office ASC";
                            $result = pg_query($connection, $query);

                            if(pg_num_rows($result) > 0){
                                while($row=pg_fetch_row($result)){
?>
                                    <tr>
                                        <td><?php echo $row[3];?></td>
                                        <td><?php echo $row[4];?></td>
                                        <td><?php echo $row[1];?></td>
                                        <td align="center" style="width: 15%;">
                                            <button class="btn btn-info btn-icon-split my-1 mr-1" id="edit_btn" data-id="<?php echo $row[0];?>" doc-id = "<?php echo $row[2];?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-pen"></i>
                                                </span>
                                            </button>

                                            <button class="btn btn-danger btn-icon-split my-1 mr-1" id="delete_btn" data-id="<?php echo $row[0];?>">
                                                <span class="icon text-white-50">
                                                    <i class="fas fa-trash"></i>
                                                </span>
                                            </button>
                                        </td>
                                    </tr>
<?php
                                }
                            }
                            else{
                                echo '<td colspan="4"><p>No assigned document(s)/office(s) found.</p></td>';
                            }
?>
                            </tbody>
                        </table>
                    </div>