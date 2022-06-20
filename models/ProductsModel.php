<?php

/**
 * Модель для таблицы продукции (products)
 * 
 */

/**
 * Получаем последние добавленные товары
 * 
 * @param integer $limit Лимит товаров
 * @return array Массив товаров 
 */
function getLastProducts($limit = null)
{
    global $db;
    $sql = "SELECT *
            FROM `products` 
            ORDER BY id DESC";
    if($limit){
        $sql .= " LIMIT {$limit}";
    }
   
    $rs = mysqli_query($db, $sql);
   
   return createSmartyRsArray($rs); 
}

/**
 * Получить продукты для категории $itemId
 * 
 * @param integer $itemId ID категории
 * @return array массив продуктов 
 */
function getProductsByCat($itemId)
{
    global $db;
   $itemId = intval($itemId);
   $sql = "SELECT * 
            FROM products
            WHERE category_id = '{$itemId}'";
   
   $rs = mysqli_query($db, $sql);
   
   return createSmartyRsArray($rs);
}


/**
 * Получить данные продукта по ID 
 * 
 * @param integer $itemId ID продукта
 * @return array массив данных продукта 
 */
function getProductById($itemId)
{
    global $db;
   $itemId = intval($itemId);
   $sql = "SELECT * 
            FROM products
            WHERE id = '{$itemId}'";
   
   $rs = mysqli_query($db, $sql);
   return mysqli_fetch_assoc($rs);   
}

/**
 * Получить список продуктов из массива идентификаторов (ID`s)
 * 
 * @param array $itemsIds массив идентификаторов продуктов
 * @return array массив данных продуктов 
 */
function getProductsFromArray($itemsIds)
{
    global $db;
    $strIds = implode(', ', $itemsIds);
    $sql = "SELECT * 
            FROM products
            WHERE id in ({$strIds})";		
    $rs = mysqli_query($db, $sql);
   
   return createSmartyRsArray($rs); 
}

function getProducts()
{
    global $db;
    $sql = "SELECT *
            FROM `products`
            ORDER BY category_id";

    $rs = mysqli_query($db, $sql);
    return createSmartyRsArray($rs);
}

//Добавление продукта
function insertProduct($itemName, $itemPrice, $itemDesc, $itemCat, $image = 0)
{
    global $db;
    $sql = "INSERT INTO products
            SET 
                `name` = '{$itemName}',
                `price` = '{$itemPrice}',
                `description` = '{$itemDesc}',
                `category_id` = '{$itemCat}',
                `image` = '{$image}'";

    $rs = mysqli_query($db, $sql);
    return $rs;
}