<?php

/**
 * Модель для таблицы клиенты (clients)
 * 
 */

/**
 * GET clients
 * @return array|false
 */
function getAllPersons()
{
    global $db;
    $sql = "SELECT *
            FROM `persons`
            ORDER BY id";

    $rs = mysqli_query($db, $sql);
    return createSmartyRsArray($rs);
}
