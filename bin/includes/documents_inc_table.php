<div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Document Code</th>
                                                    <th>Support Document</th>
                                                    <th>Trail</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Document Code</th>
                                                    <th>Support Document</th>
                                                    <th>Trail</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
<?php
                                            $user = "Dhen";
                                            $query = "SELECT scode, support_document, trail FROM accsys.maintenance_supporting_docs ORDER BY scode ASC";
                                            $result = pg_query($connection, $query);

                                            if(pg_num_rows($result) > 0){
                                                while($row=pg_fetch_row($result)){
?>
                                                    <tr>
                                                        <td><?php echo $row[0];?></td>
                                                        <td><?php echo $row[1];?></td>
                                                        <td><?php echo $row[2];?></td>
                                                        <td align="center" style="width: 15%;">
                                                            <button class="btn btn-info btn-icon-split my-1 mr-1" id="edit_btn" data-id="<?php echo $row[0];?>">
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
                                                echo '<td colspan="4"><p>No document(s) found.</p></td>';
                                            }
?>
                                            </tbody>
                                        </table>
                                    </div>