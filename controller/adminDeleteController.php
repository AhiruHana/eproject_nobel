 <?php
    include_once 'repository/adminRepository.php';
    include_once 'repository/createConnection.php';

    if ($_SERVER['REQUEST_METHOD'] == 'GET') {

        global $tableName;

        if (isset($_GET['id'])) {
            $id = ($_GET['id']);
        } else {
            $id = 0;
        }

        if ($id > 0) {
            $query = "DELETE FROM `" . $tableName . "` WHERE `id` = " . $id;
            $result = executeQuery($query);
            // var_dump($id);
            // var_dump($result);
            echoMessage("delete");
        }
    }
    ?>