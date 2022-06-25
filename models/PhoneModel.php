<?php

/***
* Добавление Телефона
*/
function insertPhone($newPhone)
{
    //Получение последнего persons
    $getPersons = getAllPersons();
    $personId = $getPersons[0]['id'];

global $db;
//Готовим запрос
$sql = "INSERT INTO
phone (`person_id`, `phone`)
VALUES ('{$personId}', '{$newPhone}')";

//Выполняем запрос
$rs = mysqli_query($db, $sql);

//Получаем id добавленной только-что записи
$id = mysqli_insert_id($db);

return $id;
}

