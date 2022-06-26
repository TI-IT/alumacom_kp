<?php

/***
 * Добавление Организации
 */
function insertCompany(
    $newNameCompany, $newOgrn,
    $newInn, $newKpp, $newAddress,
    $newOkpo, $newOkved )
{
    global $db;
    //Готовим запрос
    $sql = "INSERT INTO
            companies (`name_company`, `ogrn`, `inn`, `kpp`,
                       `address`, `okpo`, `okved_type` )
            VALUES ('{$newNameCompany}', '{$newOgrn}', '{$newInn}',
                    '{$newKpp}', '{$newAddress}', '{$newOkpo}', '{$newOkved}')";

    //Выполняем запрос
    $rs = mysqli_query($db, $sql);

    //Получаем id добавленной только-что записи
    $id = mysqli_insert_id($db);
    return $id;
}
