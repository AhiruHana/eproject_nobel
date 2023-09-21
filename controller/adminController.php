<?php
include_once 'repository/adminRepository.php';
include_once 'repository/adminSidenavRepository.php';

$tableName = $_GET['tableName'];
$result = getTable($tableName);
$fields = getColumnTable($tableName);
$fields_json = json_encode($fields);
$columnNameArr = getColumnName($tableName);
// var_dump($fields);
echo '<script>var fields =' . $fields_json . ';</script>';

if ($tableName === "feedback") {
    echo '<style>#create { display: none; }</style>';
}

function renderTable()
{
    global $tableName;
    global $result;
    global $fields;
    global $columnNameArr;

    //tên các trường
    $html = '';
    $html = $html . '<thead>';
    $html = $html . '<tr>';
    $html = $html . '<th>Action</th>';

    foreach ($fields as $f) {
        if ($f != "status") {
            $html = $html . '<th>' . ucwords($f) . '</th>';
        }
    }

    $html = $html . '</tr>';
    $html = $html . '</thead>';
    //dữ liệu
    $html = $html . '<tbody>';

    foreach ($result as $r) {
        $html = $html . '<tr>';

        //update,delete
        if ($tableName != "feedback") {
            $html = $html . '
            <td>
                <ul>
                    <li><a href="#" class="update" data-toggle="modal" data-target="#exampleModalLong"';
            foreach ($fields as $f) {
                $html = $html . ' data-' . $f . '="' . htmlspecialchars($r[$f]) . '"';
            }

            $html = $html . '>Update</a></li>
                        <li><a href="#" class="delete"  data-id="' . $r['id'] . '">Delete</a></li>
                    </ul>
                </td>
            ';
        } else {
            $html = $html . '
                <td>
                    ';
            // kiểm tra feedback đã được đọc hay chưa
            $statusValue = $r['status'] == 0 ? 'true' : 'false';

            $html = $html . '<ul><li>';

            $html = $html . '<span class=" status-span" value = "' . $statusValue . '"><b>' . ($statusValue == "true" ? "!" : "") . '</b></span>';

            $html = $html . '<a href="#" type="submit" class="view-link" data-toggle="modal" data-target="#exampleModalLong"';

            foreach ($fields as $f) {
                $html = $html . ' data-' . $f . '="' . htmlspecialchars($r[$f]) . '"';
            }
            $html = $html . '>View</a> </li>
                    <li><a href="#" class="delete"  data-id="' . $r['id'] . '">Delete</a></li>
                    </ul>
                </td>
            ';
        }

        foreach ($fields as $f) {
            if ($f != "status") {
                if ($f == "img" && $r[$f] != "") {
                    $html = $html . '<td><img class="img-mini" src= "' . $r[$f] . '"></td>';
                } else if (($f == "avatar") && $r[$f] != "") {
                    $html = $html . '<td><img class="avatar-mini" src= "' . $r[$f] . '"></td>';
                } else if ($f == "img_list" && $r[$f] != "" && $r[$f] != null) {
                    $imgList = explode(',', $r[$f]);

                    $html = $html . '<td>';
                    foreach ($imgList as $i) {
                        $html = $html . '<img class="img-list-mini" src= "' . $i . '">';
                    }
                    $html = $html . '</td>';
                } else if (in_array($f, $columnNameArr)) {
                    $referencedTableName = getReferencedTableName($tableName, $f);
                    $categoryOnTable = getCategorybyIdFK($tableName, $r[$f], $referencedTableName, $f);
                    $html = $html . '
                    <td>' . $r[$f] . ' - ' . $categoryOnTable[0]['name'] . '</td>
                ';
                } else if ($f == "winning_nobel") {
                    if ($r[$f] == "1") {
                        $html = $html . '<td>Yes</td>';
                    } else {
                        $html = $html . '<td>No</td>';
                    }
                } else {
                    $html = $html . '<td>' . $r[$f] . '</td>';
                }
            }
        }

        $html = $html . '</tr>';
    }
    $html = $html . '</tbody>';

    echo $html;
}
