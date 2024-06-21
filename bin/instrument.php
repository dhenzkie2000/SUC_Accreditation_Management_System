<?php
session_start();

include "includes/header_start.php";
include "includes/instrument_inc.php";
?>
    <title>Parameter Instruments</title>
<?php
include "includes/header_end.php";
include_once '../connection/db_connect.php';
?>
<body>
    <div id="loader" class="center"></div>
    <div id="wrapper">
        <!--Side Bar Start-->
          <ul class="navbar-nav sidebar sidebar-dark accordion" id="accordionSidebar">

                <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
                    <div class="sidebar-brand-icon">
                        <img class="uni_logo" src="../assets/images/cartoon.png">
                        <span class="uni_name">SUC-AMS</span>
                    </div>
                </a>

                <hr class="sidebar-divider my-0">

                <li class="nav-item">
                    <a class="nav-link" href="dashboard.php">
                    <i class="fas fa-fw fa-th-large" aria-hidden="true"></i>
                        <span>Dashboard</span>
                    </a>
                </li>

                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    General
                </div>
                <li class="nav-item">
                    <a class="nav-link" href="#" aria-expanded="true">
                        <i class="fas fa-fw fa-users"></i>
                        <span>Team</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" aria-expanded="true">
                        <i class="fas fa-fw fa-list"></i>
                        <span>Accreditate</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" aria-expanded="true">
                        <i class="fas fa-fw fa-building"></i>
                        <span>College / School</span>
                    </a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="#" aria-expanded="true">
                        <i class="fas fa-fw fa-handshake-o"></i>
                        <span>Evaluators</span>
                    </a>
                </li>

                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    Personal
                </div>

                <li class="nav-item">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                        aria-expanded="true" aria-controls="collapsePages">
                        <i class="fas fa-fw fa-user"></i>
                        <span>Accounts</span>
                    </a>
                    <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Manage My Account:</h6>
                            <a class="collapse-item" href="#">My Account</a>
                            <div class="collapse-divider"></div>
                            <h6 class="collapse-header">Manage Other Account:</h6>
                            <a class="collapse-item" href="users.php">Accounts</a>
                        </div>
                    </div>
                </li>

                <hr class="sidebar-divider">

                <div class="sidebar-heading">
                    System
                </div>

                <li class="nav-item active">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsettings"
                        aria-expanded="true" aria-controls="collapsettings">
                        <i class="fas fa-fw fa-gear"></i>
                        <span>Settings</span>
                    </a>
                    <div id="collapsettings" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                        <div class="bg-white py-2 collapse-inner rounded">
                            <h6 class="collapse-header">Manage System:</h6>
                            <a class="collapse-item" href="levels.php">Levels</a>
                            <a class="collapse-item" href="areas.php">Areas</a>
                            <a class="collapse-item" href="offices.php">Offices</a>
                            <a class="collapse-item" href="documents.php">Documents</a>
                            <a class="collapse-item" href="categories.php">Category</a>
                        </div>
                    </div>
                </li>

                <hr class="sidebar-divider d-none d-md-block">

                <div class="text-center d-none d-md-inline">
                    <button class="rounded-circle border-0" id="sidebarToggle"></button>
                </div>

            </ul>
        <!--Side Bar End-->
            <div id="content-wrapper" class="d-flex flex-column">
        <!-- Start Modals -->
<?php
           include "includes/instrument_modals.php";     
?>
        <!-- End Modals -->
                <div id="content">
                    <!-- NavBar Start -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <h5><span style="font-weight: bold;">Settings</span> |
                        <span><a href="areas.php" style="text-decoration: none; font-weight:bolder; color: #4e73df">Areas</a></span> 
                        > Instrument</h5>
<?php
                         include "includes/navbar_prof.php";
?>
                    </nav>
                    <!-- NavBar End -->
                    <!-- Column Start -->
                    <div class="row px-3">
                        <div class="col-lg-4">
                            <div class="card mb-5">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-secondary">Add Instrument</h6>
                                </div>
                                <div class="card-body pb-1">
                                    <form id="add_form" enctype="multipart/form-data">
                                        <input type="hidden" id="timezone" name="timezone" readonly>
                                        <div class="row border-bottom mb-2">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="area_id">Area</label>
                                                    <input type="hidden" class="form-control" id="area_id" name="area_id" value="<?php echo $_SESSION['area_id'];?>" readonly>
<?php
                                                    $get_area_name = "SELECT * FROM accsys.maintenance_area WHERE keyctr = '".$_SESSION['area_id']."'";
                                                    $get_area_name_res = pg_query($connection, $get_area_name);
                                                    $area_name=pg_fetch_row($get_area_name_res);
?>
                                                    <input type="text" class="form-control" value="<?php echo $area_name[1];?>" maxlength="6" readonly>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <label for="param_id">Parameter</label>
                                                    <input type="hidden" class="form-control" id="param_id" name="param_id" value="<?php echo $_SESSION['param_id'];?>" maxlength="6" readonly>
<?php
                                                    $get_param_name = "SELECT * FROM accsys.maintenance_area_parameter WHERE param_code = '".$_SESSION['param_id']."'";
                                                    $get_param_name_res = pg_query($connection, $get_param_name);
                                                    $param_name=pg_fetch_row($get_param_name_res);
?>
                                                    <input type="text" class="form-control" value="<?php echo $param_name[2];?>" maxlength="6" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label for="param_cat">Parameter Category:</label>
                                            <select class="form-control" id="param_cat" name="param_cat">
                                                <option value="" hidden></option>
<?php
                                                $get_cat = "SELECT * FROM accsys.maintenance_parameter_category ORDER BY order_num ASC";
                                                $cat_result = pg_query($connection, $get_cat);
                                                if(pg_num_rows($cat_result) > 0){
                                                    while($cat=pg_fetch_row($cat_result)){
?>
                                                <option value="<?php echo $cat[0];?>"><?php echo $cat[1];?></option>               
<?php
                                                    }
                                                }
                                                else{
                                                    echo "No categorie(s) found.";
                                                }
?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ins_code">Instrument Code</label>
                                            <input type="text" class="form-control" id="ins_code" name="ins_code" maxlength="6">
                                        </div>
                                        <div class="form-group">
                                            <label for="ins_desc">Description:</label>
                                            <textarea class="form-control w-100" rows="12" name="ins_desc" id="ins_desc" style="resize: none;" maxlength="300"></textarea>
                                        </div>
                                        <div class="w-100 d-flex justify-content-end">
                                            <label for="param_sub">Does it have sub-instrument?</label>
                                            <label class="switch">
                                                <input type="checkbox" value="1" name="param_sub" class="default" id="param_sub">
                                                <span class="slider round"></span>
                                            </label>
                                        </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-start">
                                        <button type="submit" class="btn btn-primary mr-2">Submit</button>
                                    </div>
                                </div>
                                </form>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-secondary">Instrument(s)</h6>
                                    </a>
                                </div>
                                <div class="card-body">
                                    <div id="display_instrument"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Column End -->
                    <!--Footer Start-->
                    <footer class="container-fluid text-center footer">
                        <span> © 2024 Copyright: SUC-AMS</span>
                    </footer>
                </div>
            </div>
    </div>
</body>
<script type="text/javascript">
    var param_id = '<?= $_SESSION['param_id']; ?>';
    var area_id = '<?= $_SESSION['area_id']; ?>';
</script>
<script type="text/javascript" src="../assets/js/loadingscreen.js"></script>
<script type="text/javascript" src="modals/js/instrument.js"></script>
<?php
include "includes/footer.php";
?>
