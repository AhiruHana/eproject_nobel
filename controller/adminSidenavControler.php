<?php

include_once 'repository/adminSidenavRepository.php';

function renderMenuTable()
{
    $table = getTableName();

    $html = '';
    foreach ($table as $t) {
        $html = $html . '
            <br><a class="nav-link" href="adminTable.php?tableName=' . $t['table_name'] . '">' . ucwords($t['table_name']) . '</a>
        ';
    }
    echo $html;
}

