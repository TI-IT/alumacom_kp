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

/***
 * Добавление физ лица
 */
function insertPerson($name, $Surname, $patronymic, $date_of_birth, $passport_number, $address)
{
    global $db;
    //Готовим запрос
    $sql =  "INSERT INTO
            persons (`surname`, `name`, `patronymic`, `date_of_birth`, `passport_number`, `residential_address`)
            VALUES ('{$Surname}', '{$name}', '{$patronymic}', '{$date_of_birth}', '{$passport_number}', '{$address}')";
    //Выполняем запрос
    $rs = mysqli_query($db, $sql);

    //Получаем id добавленной только-что записи
    $id = mysqli_insert_id($db);

    return $id;
}

/**
 * обновление  Физ лица
 *
 * @param $itemId
 * @param int $parentId
 * @param string $newName
 * @return void
 */
function updatePerson($itemId, $Surname, $name, $patronymic, $date_of_birth, $passport_number, $address)
{
    global $db;
    $set = array();

    if($Surname){
        $set[] = "`surname` = '{$Surname}'";
    }
    if($name){
        $set[] = "`name` = '{$name}'";
    }
    if($patronymic){
        $set[] = "`patronymic` = '{$patronymic}'";
    }
    if($date_of_birth){
        $set[] = "`date_of_birth` = '{$date_of_birth}'";
    }
    if($passport_number){
        $set[] = "`passport_number` = '{$passport_number}'";
    }
    if($address){
        $set[] = "`residential_address` = '{$address}'";
    }

    $setStr = implode(", ", $set);

    $sql = "UPDATE persons
            SET {$setStr}
            WHERE id = '{$itemId}'";

    $rs = mysqli_query($db, $sql);

    return $rs;
}