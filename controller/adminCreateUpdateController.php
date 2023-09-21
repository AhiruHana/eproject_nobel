<?php
include_once 'repository/adminRepository.php';
include_once 'repository/createConnection.php';
include_once 'repository/adminCreateUpdateUsersRepository.php';

$tableName = $_GET['tableName'];
$result = getTable($tableName);
$fields = getColumnTable($tableName);
$columnNameArr = getColumnName($tableName);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    global $tableName;
    $postkeys = array_keys($_POST);
    $fileKeys = array_keys($_FILES);
    // var_dump($postkeys);
    // var_dump($fileKeys);

    $fileKeysColumnsArr = $fileKeys;
    $fileKeysColumnsStr = implode(',', $fileKeys);
    $fileKeysValuesArr = [];
    $fileKeysValuesStr = "";

    foreach ($fileKeys as $f) {
        // echo ("DAY LA TEP TIN CUA " . $f);

        // Kiểm tra xem có tệp tin được gửi lên hay không
        if (!empty($_FILES[$f]['name']) && is_array($_FILES[$f]["tmp_name"])) {

            $fileList = $_FILES[$f]['name'];
            // var_dump($fileList);
            $numFiles = count($fileList);
            $arrUploaded = [];
            // echo " có " . $numFiles;
            if (!empty($fileList)) {
                for ($i = 0; $i < $numFiles; $i++) {
                    if ($_FILES[$f]["error"][$i] == UPLOAD_ERR_OK) {
                        $tmpFile = $_FILES[$f]["tmp_name"][$i];
                        $fileName = basename($_FILES[$f]["name"][$i]);
                        $uploadDir = "assets/img/upload/";
                        // if($fileList=="avatar"){
                        //     $uploadDir = "assets/img/laureates/laureate7/";
                        // }else if($fileList=="img_list"){
                        //     $uploadDir = "assets/img/laureates/laureate7/";
                        // }

                        if (!is_dir($uploadDir)) {
                            mkdir($uploadDir, 0755, true);
                        }
                        $fileDestination = $uploadDir . $fileName;
                        // echo " là " . $fileName;
                        // Lưu trữ tệp tin vào thư mục trên máy chủ
                        $allowedExtensions = array("jpg", "jpeg", "png", "jfif");
                        $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

                        if (!in_array($fileExtension, $allowedExtensions)) {
                            echo "Chỉ cho phép upload các file ảnh (jpg, jpeg, png, jfif).";
                            exit();
                        } else {
                            move_uploaded_file($tmpFile, $fileDestination);
                            array_push($arrUploaded, $fileDestination);
                        }
                    } else {
                    }
                }
            }

            $uploadedAsString = implode(',', $arrUploaded);
            array_push($fileKeysValuesArr, $uploadedAsString);
        }
    }
    $fileKeysValuesStr = implode(', ', $fileKeysValuesArr);
    // var_dump($fileKeysValuesArr);
    // var_dump( $uploadedAsString);

    if (isset($_POST['id'])) {
        $id = intval($_POST['id']);
    }
    //insert
    if ($id == 0) {
        if ($tableName == "users") {
            if (in_array('username', $postkeys) && in_array('password', $postkeys) && in_array('role', $postkeys)) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];
                $checkUsername = checkUsername($username);
                
                if (!empty($checkUsername)) {
                    
                    $_SESSION['message'] = "Oops...";
                    $_SESSION['text'] = "Username already exists! Please try again!";
                    $_SESSION['status'] = "error";

                    header("Location: adminTable.php?tableName=" . $tableName . "");
                    exit();
                } else {
                    $result = createUser($username, $password, $role);
                    echoMessage("create");
                }
            }
        } else {
            $query = "insert into `" . $tableName . "`";
            $query = $query . '(';
            for ($i = 1; $i < count($postkeys); $i++) {
                if ($i < count($postkeys) - 1) {
                    $query = $query . '`' . $postkeys[$i] . '`, ';
                }
                if ($i == count($postkeys) - 1) {
                    $query = $query . '`' . $postkeys[$i] . '`';
                }
            }
            // kiểm tra có file trong form gửi lên
            if (!empty($uploadedAsString)) {
                $query = $query . ', ';
                $query = $query . $fileKeysColumnsStr;
            }
            $query = $query . ')';
            $query = $query . ' values( ';
            for ($i = 1; $i < count($postkeys); $i++) {
                if ($i < count($postkeys) - 1) {
                    $query = $query . "'" . $_POST[$postkeys[$i]] . "', ";
                }
                if ($i == count($postkeys) - 1) {
                    $query = $query . "'" . $_POST[$postkeys[$i]] . "'";
                }
            }
            if (!empty($uploadedAsString)) {
                for ($i = 1; $i < count($fileKeysValuesArr); $i++) {
                    if ($i < count($postkeys) - 1) {
                        $query = $query . "'" . $i . "', ";
                    }
                    if ($i == count($postkeys) - 1) {
                        $query = $query . "'" . $i . "'";
                    }
                }
            }

            $query = $query . ');';
            // var_dump($query);
            $result = executeQuery($query);

            echoMessage("create");
        }
    } else {
        //update
        if ($tableName == "users") {
            if (in_array('username', $postkeys) && in_array('password', $postkeys) && in_array('role', $postkeys)) {
                $username = $_POST['username'];
                $password = $_POST['password'];
                $role = $_POST['role'];
                $result = updateUser($username, $password, $role, $id);
                echoMessage("update");
            }
        } else {
            $query = "update `" . $tableName . "` set ";
            for ($i = 1; $i < count($postkeys); $i++) {
                if ($i < count($postkeys) - 1) {
                    $query = $query . '`' . $postkeys[$i] . '` = ' . "'" . mysqli_real_escape_string(createConnection(), $_POST[$postkeys[$i]]) . "', ";
                }
                if ($i == count($postkeys) - 1) {
                    $query = $query . '`' . $postkeys[$i] . '` = ' . "'" . mysqli_real_escape_string(createConnection(), $_POST[$postkeys[$i]]) . "'";
                }
            }
            if (!empty($uploadedAsString)) {
                $query = $query . ', ';

                for ($i = 0; $i < count($fileKeysColumnsArr); $i++) {
                    if ($i < count($fileKeysColumnsArr) - 1) {
                        $query = $query . '`' . $fileKeysColumnsArr[$i] . '` = ' . "'" . mysqli_real_escape_string(createConnection(), $fileKeysValuesArr[$i]) . "', ";
                    }
                    if ($i == count($fileKeysColumnsArr) - 1) {
                        $query = $query . '`' . $fileKeysColumnsArr[$i] . '` = ' . "'" . mysqli_real_escape_string(createConnection(), $fileKeysValuesArr[$i]) . "'";
                    }
                }
            }
            $query = $query . " where `id` = '" . $id . "';";
            // var_dump($query);
            $result = executeQuery($query);
            // var_dump($result);
            echoMessage("update");
        }
    }
}

function viewCreateUpdateTable()
{
    global $fields;
    global $columnNameArr;
    global $tableName;
    $idFK = 0;

    $html = '';

    foreach ($fields as $f) {
        //ẩn tên trường
        $hidden = ($f == "id" || $f == "view" || $f == "create_date" || $f == "status") ? 'style="display:none"' : "";
        $value = ($f == "id") ? 'value="0"' : "";
        $html = $html . '
            <tr ' . $hidden . '>
                <td>' . ucwords($f) . '</td>
                ';
        if ($f === "img") {
            $html = $html . '<td>
                <div id="img-preview">
                    
                </div>
                <div>
                    <input type="file" id="img-input" class="form-control" name="' . $f . '[]" accept="image/*" multiple>
                </div>
            </td>
        ';
        } else if ($f === "avatar") {
            $html = $html . '
                <td>
                    <div id="avatar-preview">
                        
                    </div>
                    <div>
                        <input type="file" id="avatar-input" class="form-control" name="' . $f . '[]" accept="image/*" multiple>
                    </div>
                </td>
            ';
        } else if ($f === "img_list") {
            $html = $html . '
                <td>
                    <div id="image-preview-container">
                    </div>
                    <div>
                        <input type="file" id="image-list-input" name="' . $f . '[]" class="form-control" accept="image/*" multiple>
                    </div>
                </td>
            ';
        } else if (in_array($f, $columnNameArr)) {
            $referencedTableName = getReferencedTableName($tableName, $f);
            $categoryOnTable = getCategorybyIdFK($tableName, $idFK, $referencedTableName, $f);

            $html = $html . '
                <td>
                    <div class="form-control" style="padding:0">
                        <select name="' . $f . '" id="' . $f . '">';
            foreach ($categoryOnTable as $c) {
                $html = $html . '
                    <option value="' . $c['id'] . '">' . $c['id'] . ' - ' . $c['name'] . '</option>
                ';
            }
            $html = $html . '         
                        </select>
                    </div>
                </td>
            ';
        } else if ($f == "winning_nobel") {
            $html = $html . '
                <td>
                    <div class="form-control" style="padding:0">
                        <select name="' . $f . '" id="' . $f . '">
                            <option value="0">No</option>
                            <option value="1">Yes</option>
                        </select>
                    </div>
                </td>
            ';
        } else if ($f == "role") {
            $html = $html . '
                <td>
                    <div class="form-control" style="padding:0">
                        <select name="' . $f . '" id="' . $f . '" required>
                            <option value="admin">Admin</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </td>
            ';
        } else {
            $html = $html . '
                <td><input id="' . $f . '" ' . $value . ' class="form-control" name ="' . $f . '" > </td>
            ';
        }
        $html = $html . '</tr>';

        //thêm input passwword
        if ($tableName == "users" && $f == "username") {
            $html = $html . '
                <tr id="passwordRow">
                    <td id="td-password">Password</td>
                    <td class="input-password-container">
                        <input type="password" id="password" class="form-control" name ="password" required> 
                        <span id="toggle-password" class="password-toggle" onclick="togglePasswordVisibility(\'password\',\'toggle-password\')"><i class="fa-solid fa-eye"> </i></span>
                    </td>
                </tr>
                
            ';
        }
    }
    echo $html;
}
function echoMessage($action)
{
    global $result;
    global $tableName;
    if ($result === true) {
        if ($action == "delete") {
            $_SESSION['message'] = "Deleted!";
            $_SESSION['text'] = "Your record has been deleted.";
            $_SESSION['status'] = "success";
        } else {
            $_SESSION['message'] = "" . ucwords($action) . " successfully!";
            $_SESSION['text'] = "";
            $_SESSION['status'] = "success";
        }

        header("Location: adminTable.php?tableName=" . $tableName . "");
        exit();
    } else {
        $_SESSION['message'] = "Oops...";
        $_SESSION['text'] = "Failed to " . $action . "! Please try again!";
        $_SESSION['status'] = "error";

        header("Location: adminTable.php?tableName=" . $tableName . "");
        exit();
    }
}
