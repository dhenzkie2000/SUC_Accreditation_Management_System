<?php
include "includes/header_start.php";
include "includes/document_inc.php";
?>
    <title>Configure Support Documents</title>
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
                    <a class="nav-link" href="#">
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
                            <a class="collapse-item active" href="#">Documents</a>
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
           include "includes/document_modals.php";     
?>
        <!-- End Modals -->
                <div id="content">
                    <!-- NavBar Start -->
                    <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                        <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                            <i class="fa fa-bars"></i>
                        </button>

                        <h5><span style="font-weight: bold;">Settings</span> | Documents</h5>
<?php
                         include "includes/navbar_prof.php";
?>
                    </nav>
                    <!-- NavBar End -->
                    <!-- Column Start -->
                    <div class="row px-3">
                        <div class="col-lg-9">
                            <div class="card mb-5">
                                <div class="card-header py-3 d-flex align-items-center justify-content-between">
                                    <h6 class="m-0 font-weight-bold text-secondary">Documents</h6>
                                    <a href="#sc_add" class="split_add_btn">
                                        <button class="btn btn-default btn-icon-split">
                                            <span class="icon text-black-50">
                                                <i class="fas fa-plus"></i>
                                            </span>
                                        </button>
                                    </a>
                                </div>
                                <div class="card-body">
<?php
                                     include "includes/documents_inc_table.php";
?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3">
                            <div class="card mb-3" id="sc_add">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-secondary">Add Support Document</h6>
                                </div>
                                <div class="card-body">
                                    <form id="add_form" enctype="multipart/form-data">
                                        <input type="hidden" id="timezone" name="timezone" readonly>
                                        <div class="form-group">
                                            <label for="doc_code">Document Code</label>
                                            <input type="text" class="form-control" id="doc_code" name="doc_code" maxlength="6">
                                        </div>
                                        <div class="form-group">
                                            <label for="doc_sup">Support Document:</label>
                                            <textarea class="form-control w-100" rows="15" name="doc_sup" id="doc_sup" style="resize: none;"></textarea>
                                        </div>
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            <div class="mb-4">
                                <a href="assign_docs_office.php">
                                    <button class="btn btn-primary btn-icon-split" id="assign_off" type="button">
                                        <span class="icon text-white-50">
                                            <i class="fas fa-building"></i>
                                        </span>
                                        <span class="text">Assign Office(s)</span>
                                    </button>
                                </a>
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
<script type="text/javascript" src="../assets/js/loadingscreen.js"></script>
<script type="text/javascript" src="modals/js/documents.js"></script>
<?php
include "includes/footer.php";
?>
