<?php
/**
 * Контроллер бэкенда сайта
 */

// подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';
include_once '../models/ClientsModel.php';
include_once '../models/MaterialsModel.php';
include_once '../models/SpeciesModel.php';
include_once '../models/SuppliersModel.php';
include_once '../models/PersonsModel.php';
include_once '../models/PhoneModel.php';
include_once '../models/ApiClientDataModel.php';
include_once '../models/CompanyModel.php';

$smarty->setTemplateDir(TemplateAdminPrefix);
$smarty->assign('templateAdminWebPath', TemplateAdminWebPath);
//d($smarty);

/**
 * Страница главная
 * @param $smarty
 * @return void
 */
function indexAction($smarty){
    $smarty->assign('pageTitle', 'Управление сайтом');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'admin');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * Страница Организации
 * @param $smarty
 * @return void
 */
function companyAction($smarty){
    $rsCompanies = getAllCompanies();

    if( !$_SESSION['apiData']['apiInnData'] ){
        $rsSessionCompany = '';
        $smarty->assign('rsSessionCompany', $rsSessionCompany);
    }else{
        $rsSessionCompany = $_SESSION['apiData']['apiInnData'];
        $smarty->assign('rsSessionCompany', $rsSessionCompany);
    }

    $smarty->assign('rsCompanies', $rsCompanies);
    $smarty->assign('pageTitle', 'Управление сайтом');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminCompany');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * Страница Клиенты
 * @param $smarty
 * @return void
 */
function clientsAction($smarty){
    $var = 'Client';
    $rsClients = getAllClients();
    $rsMainClients = getAllMainClients();

    $smarty->assign('rsClients', $rsClients);
    $smarty->assign('rsMainClients', $rsMainClients);
    $smarty->assign('var', $var);
    $smarty->assign('pageTitle', 'Управление клиентами');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminClients');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * Страница Клиенты
 * @param $smarty
 * @return void
 */
function purchaseAction($smarty){
    $var = 'Client';
    $rsClients = getAllClients();
    $rsMainClients = getAllMainClients();

    $smarty->assign('rsClients', $rsClients);
    $smarty->assign('rsMainClients', $rsMainClients);
    $smarty->assign('var', $var);
    $smarty->assign('pageTitle', 'Управление клиентами');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminClients');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * Страница Физ лицо
 * @param $smarty
 * @return void
 */
function personsAction($smarty){
    $rsPersons = getAllPersons();
    $rsPhone = getAllPhone();

    $smarty->assign('rsPersons', $rsPersons);
    $smarty->assign('rsPhone', $rsPhone);
    $smarty->assign('pageTitle', 'Физ лицо');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminPersons');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * Страница Поставщики
 * @param $smarty
 * @return void
 */
function suppliersAction($smarty){
    $rsSuppliers = getAllSuppliers();
    $rsMainSuppliers = getAllMainSuppliers();
    $rsMainCategories = getAllMainCategories();
    $rsCategories = getAllCategories();
    $rsClients = getAllClients();

    $smarty->assign('rsSuppliers', $rsSuppliers);
    $smarty->assign('rsMainSuppliers', $rsMainSuppliers);
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsMainCategories', $rsMainCategories);
    $smarty->assign('rsClients', $rsClients);

    $smarty->assign('pageTitle', 'Управление клиентами');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminSuppliers');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * Страница Категории
 */
function categoryAction($smarty){
    $rsCategories = getAllCategories();
    $rsMainCategories = getAllMainCategories();
    $rsSpecies = getAllSpecies();
    $rsMainSpecies = getAllMainSpecies();
    $rsMaterials = getAllMaterials();
    $rsMainMaterials = getAllMainMaterials();

    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsMainCategories', $rsMainCategories);
    $smarty->assign('rsSpecies', $rsSpecies);
    $smarty->assign('rsMainSpecies', $rsMainSpecies);
    $smarty->assign('rsMaterials', $rsMaterials);
    $smarty->assign('rsMainMaterials', $rsMainMaterials);
    $smarty->assign('pageTitle', 'Управление сайтом');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminSpecies');
    loadTemplate($smarty, 'adminCategory');
    loadTemplate($smarty, 'adminMaterials');
    loadTemplate($smarty, 'adminFooter');
}

/**
 * Страница работы с Товарами
 * @param $smarty
 * @return void
 */
function productsAction($smarty){
    $rsCategories = getAllCategories();
    $rsProducts = getProducts();
    $rsMaterials = getAllMaterials();

    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);
    $smarty->assign('rsMaterials', $rsMaterials);

    $smarty->assign('pageTitle', 'Управление сайтом');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminProducts');
    loadTemplate($smarty, 'adminFooter');
}

function addnewcatAction(){
    $catName = $_POST['newCategoryName'];
    $catParentId = $_POST['generalCatId'];

    $res = insertCat($catName, $catParentId);
    $message0 = 'ощибка добавления категории';
    $message1 = 'категория добавлена';

    resDataJsonEncode($res, $message0, $message1);
}

function addnewphoneAction(){
    $newPhone = $_POST['phone'];

    $res = insertPhone($newPhone);
    $message0 = 'ощибка добавления телефона';
    $message1 = 'категория добавлена';

    resDataJsonEncode($res, $message0, $message1);
}

/**
 * Добавление поставщика
 * @return void
 */
function addnewsuppliersAction(){
    $suppliersName = $_POST['newSuppliersName'];
    $categoryId = $_POST['selectCategoriesSuppliersId'];
    $client_id = $_POST['selectClientsSuppliersId'];

    $res = insertSuppliers($categoryId, $client_id, $suppliersName);
    $message0 = 'ощибка добавления категории';
    $message1 = 'категория добавлена';

    resDataJsonEncode($res, $message0, $message1);
}

/**
 * Добавление Организации
 * @return void
 */
function addnewcompanyAction(){
    if($_POST['newNameCompany'] && $_POST['newInn']){
        $newNameCompany = $_POST['newNameCompany'];
        $newOgrn = $_POST['newOgrn'];
        $newInn = $_POST['newInn'];
        $newKpp = $_POST['newKpp'];
        $newAddress = $_POST['newAddress'];
        $newOkpo = $_POST['newOkpo'];
        $newOkved = $_POST['newOkved'];

        $innCount = (int)iconv_strlen($newInn);
        if($innCount >=10 && $innCount <13){
            $res = insertCompany($newNameCompany, $newOgrn,
                $newInn, $newKpp, $newAddress, $newOkpo, $newOkved );
            $message0 = 'ощибка добавления категории';
        }else{
            $message0 = 'Длинна ИНН не соответствует';
        }

    }else{
        $message0 = 'Заполните поля название и инн организации';
    }

    $message1 = 'категория добавлена';

    resDataJsonEncode($res, $message0, $message1);
}/**
 * Добавление Организации
 * @return void
 */

function updatecompanyAction(){

    if($_POST['newNameCompany']){
        $itemId = $_POST['companuItemId'];
        $newNameCompany = $_POST['newNameCompany'];
        $newOgrn = $_POST['newOgrn'];
        $newInn = $_POST['newInn'];
        $newKpp = $_POST['newKpp'];
        $newAddress = $_POST['newAddress'];
        $newOkpo = $_POST['newOkpo'];
        $newOkved = $_POST['newOkved'];

        $res = updateCompany($itemId, $newNameCompany, $newOgrn,
            $newInn, $newKpp, $newAddress, $newOkpo, $newOkved );
        $message0 = 'ощибка изменения Организации';
    }else{
        $message0 = 'Заполните название Организации';
    }

    $message1 = 'Изменения внесены';

    resDataJsonEncode($res, $message0, $message1);
}

/**
 * Добавление Организации из Интернета
 * @return void
 */
function addapiinnsessiondataAction(){

    $newNameCompany = $_SESSION['apiData']['apiInnData']['suggestions'][0]['value'];
    $newOgrn = (int)$_SESSION['apiData']['apiInnData']['suggestions'][0]['data']['ogrn'];
    $newInn = (int)$_SESSION['apiData']['apiInnData']['suggestions'][0]['data']['inn'];
    $newKpp = (int)$_SESSION['apiData']['apiInnData']['suggestions'][0]['data']['kpp'];
    $newAddress = $_SESSION['apiData']['apiInnData']['suggestions'][0]['data']['address']['unrestricted_value'];
    $newOkpo = (int)$_SESSION['apiData']['apiInnData']['suggestions'][0]['data']['okpo'];
    $newOkved = $_SESSION['apiData']['apiInnData']['suggestions'][0]['data']['okved'];

    $res = insertCompany($newNameCompany, $newOgrn,
        $newInn, $newKpp, $newAddress, $newOkpo, $newOkved );

    $message0 = 'ощибка добавления категории';
    $message1 = 'категория добавлена';

    $_SESSION['apiData']['apiInnData'] = '';
    resDataJsonEncode($res, $message0, $message1);

}

/**
 * Добавление Физ лица
 * @return void
 */
function addnewpersonsAction(){
    $Surname = $_POST['newPersonSurname'];
    $name = $_POST['newPersonName'];
    $patronymic = $_POST['newPersonPatronymic'];
//    $date_of_birth = $_POST['newPersonDate_of_birth'];
//    $passport_number = $_POST['newPersonPassport_number'];
//    $address = $_POST['newPersonResidential_address'];

    $res = insertPerson($name, $Surname, $patronymic);
    $message0 = 'ощибка добавления физ лица';
    $message1 = 'категория добавлена';

    resDataJsonEncode($res, $message0, $message1);
}

function addnewmaterialAction(){
    $materialName = $_POST['newMaterialsName'];
    $materialParentId = $_POST['generalMaterials'];

    $res = insertMaterials($materialName, $materialParentId);
    $message0 = 'ощибка добавления категории';
    $message1 = 'категория добавлена';

    resDataJsonEncode($res, $message0, $message1);
}

/**
 * Обновление категории
 * @return void
 */
function updatecategoryAction(){
    $itemId = $_POST['itemId'];
    $parentId = $_POST['parentId'];
    $newName = $_POST['newName'];

    $res = updateCategoryData($itemId, $parentId, $newName);
    $message0 = 'Ощибка изменения данных категории';
    $message1 = 'Категория обнавлена';

    resDataJsonEncode($res, $message0, $message1);
}

/**
 * Обновление Поставщика
 * @return void
 */
function updatesuppliersAction(){
    $itemId = $_POST['itemId'];
    $categoryId = $_POST['categoryId'];
    $newName = $_POST['newName'];

    $res = updateSuppliersData($itemId, $categoryId, $newName);
    $message0 = 'Ощибка изменения данных категории';
    $message1 = 'Категория обнавлена';

    resDataJsonEncode($res, $message0, $message1);
}

/**
 * Обновление Физ лица
 * @return void
 */
function updatepersonsAction(){
    $itemId = $_POST['itemId'];
    $Surname = $_POST['Surname'];
    $name = $_POST['name'];
    $patronymic = $_POST['patronymic'];
    $date_of_birth = $_POST['date_of_birth'];
    $passport_number = $_POST['passport_number'];
    $address = $_POST['address'];


    $res = updatePerson($itemId, $Surname, $name, $patronymic, $date_of_birth, $passport_number, $address);
    $message0 = 'Ощибка изменения данных физ лица';
    $message1 = 'Данные физ лица обнавлены';

    resDataJsonEncode($res, $message0, $message1);
}

/**
 * Обновление вида товара
 * @return void
 */
function updatespeciesAction(){
    $itemId = $_POST['itemId'];
    $parentId = $_POST['parentId'];
    $newName = $_POST['newName'];

    $res = updateSpeciesData($itemId, $parentId, $newName);
    $message0 = 'Ощибка изменения данных категории';
    $message1 = 'Категория обнавлена';

    resDataJsonEncode($res, $message0, $message1);
}

/**
 * Обновление вида товара
 * @return void
 */
function updatematerialsAction(){
    $itemId = $_POST['itemId'];
    $parentId = $_POST['parentId'];
    $newName = $_POST['newName'];

    $res = updateMaterialsData($itemId, $parentId, $newName);
    $message0 = 'Ощибка изменения данных категории';
    $message1 = 'Категория обнавлена';

    resDataJsonEncode($res, $message0, $message1);
}


function addproductAction(){
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemDesc = $_POST['itemDesc'];
    $itemCat = $_POST['itemCatId'];
    $image = $_POST['image'];

    $res = insertProduct($itemName, $itemPrice, $itemDesc, $itemCat, $image);
    $message0 = 'Ошибка Добавления данных';
    $message1 = 'Добавление успешно внесены';

    resDataJsonEncode($res, $message0, $message1);
}

function updateproductAction(){

    $itemId = $_POST['itemId'];
    $itemName = $_POST['itemName'];
    $itemPrice = $_POST['itemPrice'];
    $itemStatus = $_POST['itemStatus'];
    $itemDesc = $_POST['itemDesc'];
    $itemCat = $_POST['itemCatId'];

    $res = updateProduct($itemId, $itemName, $itemPrice, $itemStatus, $itemDesc, $itemCat);
    $message0 = 'Ошибка изменения данных';
    $message1 = 'изменения успешно внесены';

    resDataJsonEncode($res, $message0, $message1);
}

function uploadAction(){
    $maxSize = 2 * 1024 * 1024;

    $itemId = $_POST['itemId'];
    //Получаем расширение загружаемого файла
    $ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);
    //Создаем имя файла
    $newFileName = $itemId . '.' . $ext;
    if($_FILES["filename"]["size"] > $maxSize){
        echo ("Размер файла превышает два мегабайта");
        return;
    }
    //Загружен ли файл
    if(is_uploaded_file($_FILES['filename']['tmp_name'])){
        //Если файл загружен то перемещаем его из временной директории в конечную
        $res = move_uploaded_file($_FILES['filename']['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . '/images/products/' . $newFileName);
        if($res){
            $res = updateProductImage($itemId, $newFileName);
            if($res){
                redirect('/admin/products/');
            }
        }
    }else{
        echo("ошибка загрузки файла");
    }
}

function ordersAction($smarty){

    $rsOrders = getOrders();
    $smarty->assign('rsOrders', $rsOrders);
    $smarty->assign('pageTitle', 'Заказы');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminOrders');
    loadTemplate($smarty, 'adminFooter');


}

//Получение Данных по ИНН
function getapiinndataAction(){

    $message0 = 'ИНН не корректный';
    if($_SESSION['apiData']['apiInnData']){
        $innSession = $_SESSION['apiData']['apiInnData']["suggestions"][0]["data"]['inn'];
    }
    $inn = $_POST['getApiInn'];
    $countInn = (int)iconv_strlen($inn);
    $innDbTrue = getAllCompaniesInn($inn);
    $res = false;
    $innGo = false;

    if(!$inn){
        $message0 = 'Введите ИНН';
    }elseif ($innSession == $inn){
        $message0 = 'ИНН уже найден';
    }elseif ($innDbTrue){
        $message0 = 'ИНН в базе существует';
    }elseif($countInn <10 || $countInn >13){
        $message0 = 'Ошибка в количестве введенных чисел';
    }else{
        $innGo = true;
    }

    if($innGo){
        $message1 = 'Организация найдена';
        $res = getApiInnData($inn);
        $_SESSION['apiData']['apiInnData'] = $res;
        if($res['suggestions'][0] == null){
            $message1 = 'Организация не найдена';
            $_SESSION['apiData']['apiInnData'] = '';
        }
    }
    resDataJsonEncode($res, $message0, $message1);

}

//Получение Данных по банку
function getapibankdataAction(){
    $inn = $_POST['getApiBank'];

    $res = getApiBankData($inn);
    $message0 = 'ощибка добавления категории';
    $message1 = 'категория добавлена';
    resDataJsonEncode($res, $message0, $message1);
}
