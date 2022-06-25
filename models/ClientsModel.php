<?php

/**
 * Модель для таблицы клиенты (clients)
 * 
 */

/**
 * GET clients
 * @return array|false
 */
function getAllClients()
{
    global $db;
    $sql = "SELECT *
            FROM `clients`
            ORDER BY parent_id = '1'";

    $rs = mysqli_query($db, $sql);
    return createSmartyRsArray($rs);
}

function getAllMainClients()
{
    global $db;
    $sql = 'SELECT *
            FROM clients
            WHERE category_id = 0';

    $rs = mysqli_query($db, $sql);

    return createSmartyRsArray($rs);
}
