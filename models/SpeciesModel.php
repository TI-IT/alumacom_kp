<?php

/**
* обновление вида товара
*
* @param $itemId
* @param int $parentId
* @param string $newName
* @return void
*/
function updateSpeciesData($itemId, int $parentId = -1, string $newName = '')
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

$sql = "UPDATE species
SET {$setStr}
WHERE id = '{$itemId}'";

$rs = mysqli_query($db, $sql);

return $rs;
}

/***
 * Добавление вида товара
 * @param $catName
 * @param $catParentId
 * @return int|string
 */
function insertSpecies($speciesName, $speciesParentId = 0)
{
    global $db;
    //Готовим запрос
    $sql = "INSERT INTO
            species (`parent_id`, `name`)
            VALUES ('{$speciesParentId}', '{$speciesName}')";

    //Выполняем запрос
    $rs = mysqli_query($db, $sql);

    //Получаем id добавленной только-что записи
    $id = mysqli_insert_id($db);

    return $id;
}

function getAllMainSpecies()
{
    global $db;
    $sql = 'SELECT *
            FROM species
            WHERE parent_id = 0';

    $rs = mysqli_query($db, $sql);

    return createSmartyRsArray($rs);
}

function getAllSpecies()
{
    global $db;
    $sql = 'SELECT *
            FROM species
            ORDER BY `parent_id` ASC';

    $rs = mysqli_query($db, $sql);

    return createSmartyRsArray($rs);
}