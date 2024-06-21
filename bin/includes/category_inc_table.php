<div class="table-responsive">
                                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                            <thead>
                                                <tr>
                                                    <th>Category Code</th>
                                                    <th>Description</th>
                                                    <th>Placement Number</th>
                                                    <th>Trail</th>
                                                    <th>Action</th>
                                                </tr>
                                            </thead>
                                            <tfoot>
                                                <tr>
                                                    <th>Category Code</th>
                                                    <th>Description</th>
                                                    <th>Placement Number</th>
                                                    <th>Trail</th>
                                                    <th>Action</th>
                                                </tr>
                                            </tfoot>
                                            <tbody>
<?php
                                            $user = "Dhen";
                                            $query = "SELECT cat_code, description, trail, order_num FROM accsys.maintenance_parameter_category ORDER BY order_num ASC";
                                            $result = pg_query($connection, $query);

                                            if(pg_num_rows($result) > 0){
                                                while($row=pg_fetch_row($result)){
?>
                                                    <tr>
                                                        <td><?php echo $row[0];?></td>
                                                        <td><?php echo $row[1];?></td>
                                                        <td><?php echo $row[3];?></td>
                                                        <td>
                                                            <?php 
                                                                if($row[2] == ""){
                                                                    echo "None";
                                                                }
                                                                else{
                                                                    echo $row[2];
                                                                }
                                                            ?>
                                                        </td>
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
                                                echo '<td colspan="4"><p>No category found.</p></td>';
                                            }
?>
                                            </tbody>
                                        </table>
                                </div>