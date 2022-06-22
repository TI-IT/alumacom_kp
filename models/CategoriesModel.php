<?php

/**
 * Модель для таблицы категорий (categories)
 * 
 */


 /**
 * Получить дочернии категории для категории $catId
 * 
 * @param integer $catId ID категории
 * @return array массив дочерних категорий 
 */

function getChildrenForCat($catId)
{
    global $db;
   $sql = "SELECT * 
            FROM categories
            WHERE 
            parent_id = '{$catId}'";
       
   $rs = mysqli_query($db, $sql);
	
   return createSmartyRsArray($rs); 
}
 


/**
 * Получить главные категории с привязками дочерних
 * 
 * @return array массив категорий 
 */
function getAllMainCatsWithChildren(){

    global $db;

	$sql = 'SELECT * 
            FROM categories
            WHERE parent_id = 0';
	
	$rs = mysqli_query($db, $sql);
	
	$smartyRs = array();
	while ($row = mysqli_fetch_assoc($rs)) {
		
		$rsChildren = getChildrenForCat($row['id']);

        if($rsChildren){
            $row['children'] = $rsChildren;
        }
		
       $smartyRs[] = $row;
    }	

	return $smartyRs;
}


/**
 * Получить данные категории по id
 * 
 * @param integer $catId ID категории
 * @return array массив - строка категории 
 */
function getCatById($catId)
{
    global $db;
   $catId = intval($catId);
   $sql = "SELECT * 
            FROM categories
            WHERE 
            id = '{$catId}'";
            
   $rs = mysqli_query($db, $sql);
   
   return mysqli_fetch_assoc($rs); 
    
}

function getAllMainCategories()
{
    global $db;
    $sql = 'SELECT *
            FROM categories
            WHERE parent_id = 0';

    $rs = mysqli_query($db, $sql);

    return createSmartyRsArray($rs);
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

/***
 * Добавление категории
 * @param $catName
 * @param $catParentId
 * @return int|string
 */
function insertCat($catName, $catParentId = 0)
{
    global $db;
    //Готовим запрос
    $sql = "INSERT INTO
            categories (`parent_id`, `name`)
            VALUES ('{$catParentId}', '{$catName}')";

    //Выполняем запрос
    $rs = mysqli_query($db, $sql);

    //Получаем id добавленной только-что записи
    $id = mysqli_insert_id($db);

    return $id;
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

/**
 * получить все категории
 */
function getAllCategories()
{
    global $db;
    $sql = 'SELECT *
            FROM categories
            ORDER BY `parent_id` ASC';

    $rs = mysqli_query($db, $sql);

    return createSmartyRsArray($rs);
}

/**
 * обновление категории
 *
 * @param $itemId
 * @param int $parentId
 * @param string $newName
 * @return void
 */
function updateCategoryData($itemId, int $parentId = -1, string $newName = '')
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

    $sql = "UPDATE categories
            SET {$setStr}
            WHERE id = '{$itemId}'";

    $rs = mysqli_query($db, $sql);

    return $rs;
}

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