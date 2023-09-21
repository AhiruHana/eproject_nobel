<?php

session_start();

include_once 'controller/adminController.php';
include_once 'controller/adminCreateUpdateController.php';
include_once 'controller/adminDeleteController.php';

if (!isset($_COOKIE["login-admin"]) ||  !isset($_SESSION["role"]) || $_SESSION["role"] !== "admin") {
    header("Location: login.php");
}


?>
<!DOCTYPE html>
<html lang="en">
<?php
include_once 'layout/adminHead.php';
?>

<body class="sb-nav-fixed">
    <?php
    include_once 'layout/adminHeader.php';
    ?>
    <div id="layoutSidenav">
        <?php
        include_once 'layout/adminSidenav.php';
        ?>
        <div id="layoutSidenav_content">
            <main>
                <div class="container-fluid px-4">
                    <h2 class="pt-5"><?php echo ucwords($tableName) ?> Table</h2><br>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            DataTable Example
                        </div>
                        <div class="card-body ">
                            <button id="create" class="btn btn-success" data-toggle="modal" data-target="#exampleModalLong">
                                Create</button>
                            <div>
                                <table id="datatablesSimple">
                                    <?php
                                    renderTable();
                                    ?>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
            <?php
            include_once 'layout/adminFooter.php';
            ?>
        </div>


        <!-- Modal -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form id="create-update-form" class="modal-content" method="post" action="adminTable.php?tableName=<?php echo $tableName ?>" enctype="multipart/form-data">
                    <div class="modal-header">

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="container-fluid px-4">
                            <div class="card mb-4">
                                <div class="card-body">
                                    <div>
                                        <table class="table table-border">

                                            <?php
                                            viewCreateUpdateTable();

                                            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn btn-warning" data-dismiss="modal">Close</button>
                        <?php
                        if ($tableName != "feedback") {
                            echo '<button type="submit" class="btn btn btn-success">Save</button>';
                        }
                        ?>
                    </div>
                </form>
            </div>
        </div>

    </div>
    <?php
    include_once 'layout/adminScript.php';
    ?>
</body>

</html>