<?php

/**
 * Модель для таблицы материалов (Materials)
 * 
 */

/**
 * GET Materials
 * @return array|false
 */
function getAllMaterials()
{
    global $db;
    $sql = "SELECT *
            FROM `materials`
            ORDER BY parent_id ASC";

    $rs = mysqli_query($db, $sql);
    return createSmartyRsArray($rs);
}

function getAllMainMaterials()
{
    global $db;
    $sql = 'SELECT *
            FROM materials
            WHERE parent_id = 0';

    $rs = mysqli_query($db, $sql);

    return createSmartyRsArray($rs);
}

/**
 * обновление материала
 *
 * @param $itemId
 * @param int $parentId
 * @param string $newName
 * @return void
 */

function updateMaterialsData($itemId, int $parentId = -1, string $newName = '')
{
    global $db;
    $set = array();

    if($newName){
        $set[] = "`name` = '{$newName}'";
    }
    if($parentId > -1){
        $set[] = "`parent_id` = '{$parentId}'";
    }

    $setStr = implode(", ", $set);

    $sql = "UPDATE materials
            SET {$setStr}
            WHERE id = '{$itemId}'";

    $rs = mysqli_query($db, $sql);

    return $rs;
}

/***
 * Добавление нового материала

 */
function insertMaterials($materialName, $materialParentId = 0)
{
    global $db;
    //Готовим запрос
    $sql = "INSERT INTO
            materials (`parent_id`, `name`)
            VALUES ('{$materialParentId}', '{$materialName}')";

    //Выполняем запрос
    $rs = mysqli_query($db, $sql);

    //Получаем id добавленной только-что записи
    $id = mysqli_insert_id($db);

    return $id;
}