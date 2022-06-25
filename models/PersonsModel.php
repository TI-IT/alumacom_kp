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
function insertPerson($Surname = null, $name, $patronymic = null, $date = null, $passport_number = null, $address = null)
{
    global $db;
    //Готовим запрос
    $sql = "INSERT INTO
            persons (`surname`, `name`, `patronymic`, `date_of_birth`, `passport_number`, `residential_address`)
            VALUES ('{$Surname}', '{$name}', '{$patronymic}', '{$date}', '{$passport_number}', '{$address}')";

    d($sql);
    //Выполняем запрос
    $rs = mysqli_query($db, $sql);

    //Получаем id добавленной только-что записи
    $id = mysqli_insert_id($db);

    return $id;
}