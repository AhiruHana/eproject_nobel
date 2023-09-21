<?php
include_once 'controller/adminSidenavControler.php';
?>

<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <a class="nav-link" href="admin.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>

                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Tables
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <?php
                        renderMenuTable()
                        ?>
                    </nav>
                </div>
                <a class="nav-link" href="adminTable.php?tableName=feedback">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-comments"></i></div>
                    <span class="mr-4">Feedback </span>
                    <span id="unread-count" class="badge bg-danger ml-5"></span>
                    
                </a>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Page
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="adminTable.php?tableName=config">Config</a>
                        <a class="nav-link" href="adminTable.php?tableName=menu">Menu</a>
                    </nav>
                </div>
                <a class="nav-link" href="adminTable.php?tableName=users">
                    <div class="sb-nav-link-icon"><i class="fa-solid fa-users"></i></div>
                    Accounts Management
                </a>
            </div>
        </div>

    </nav>
</div>