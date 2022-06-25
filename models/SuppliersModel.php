<?php

/**
 * GET clients
 * @return array|false
 */
function getAllSuppliers()
{
    global $db;
    $sql = "SELECT *
            FROM `suppliers`
            ORDER BY id ";

    $rs = mysqli_query($db, $sql);
    return createSmartyRsArray($rs);
}


function getAllMainSuppliers()
{
    global $db;
    $sql = 'SELECT *
            FROM suppliers
            WHERE category_id = 0';

    $rs = mysqli_query($db, $sql);

    return createSmartyRsArray($rs);
}


/**
 * обновление поставщика
 *
 * @param $itemId
 * @param int $parentId
 * @param string $newName
 * @return void
 */
function updateSuppliersData($itemId, int $categoryId = -1, string $newName = '')
{
    global $db;
    $set = array();

    if($newName){
        $set[] = "`name` = '{$newName}'";
    }
    if($categoryId > -1){
        $set[] = "`category_id` = '{$categoryId}'";
    }

    $setStr = implode(", ", $set);

    $sql = "UPDATE categories
            SET {$setStr}
            WHERE id = '{$itemId}'";

    $rs = mysqli_query($db, $sql);

    return $rs;
}


/***
 * Добавление поставщика
 */
function insertSuppliers($categoryId = 0, $client_id = 0, $suppliersName)
{
    global $db;
    //Готовим запрос
    $sql = "INSERT INTO
            suppliers (`category_id`, `client_id`, `name`)
            VALUES ('{$categoryId}', '{$client_id}', '{$suppliersName}')";


    //Выполняем запрос
    $rs = mysqli_query($db, $sql);

    //Получаем id добавленной только-что записи
    $id = mysqli_insert_id($db);

    return $id;
}
