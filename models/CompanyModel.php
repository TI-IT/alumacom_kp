<?php

/**
 * получить все категории
 */
function getAllCompanies()
{
    global $db;
    $sql = 'SELECT *
            FROM companies
            ORDER BY `id` DESC';

    $rs = mysqli_query($db, $sql);

    return createSmartyRsArray($rs);
}

/**
 * получить все категории
 */
function getAllCompaniesInn($inn)
{
    global $db;
    $sql = "SELECT *
            FROM companies
            WHERE inn = {$inn}";

    $rs = mysqli_query($db, $sql);

    return createSmartyRsArray($rs);
}



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


/**
 * обновление организации
 *
 * @param $itemId
 * @param int $parentId
 * @param string $newName
 * @return void
 */
function updateCompany($itemId, $newNameCompany, $newOgrn,
                       $newInn, $newKpp, $newAddress, $newOkpo, $newOkved )
{
    global $db;
    $set = array();
    $set[] = "`name_company` = '{$newNameCompany}'";
    $set[] = "`ogrn` = '{$newOgrn}'";
    $set[] = "`inn` = '{$newInn}'";
    $set[] = "`kpp` = '{$newKpp}'";
    $set[] = "`address` = '{$newAddress}'";
    $set[] = "`okpo` = '{$newOkpo}'";
    $set[] = "`okved_type` = '{$newOkved}'";


    $setStr = implode(", ", $set);


    $sql = "UPDATE companies
            SET {$setStr}
            WHERE id = '{$itemId}'";
    $rs = mysqli_query($db, $sql);

    return $rs;
}
