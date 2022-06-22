<?php
/**
 * Контроллер бэкенда сайта
 */

// подключаем модели
include_once '../models/CategoriesModel.php';
include_once '../models/ProductsModel.php';
include_once '../models/OrdersModel.php';
include_once '../models/PurchaseModel.php';

$smarty->setTemplateDir(TemplateAdminPrefix);
$smarty->assign('templateAdminWebPath', TemplateAdminWebPath);
//d($smarty);

function indexAction($smarty){
    $rsCategories = getAllMainCategories();
    $rsSpecies = getAllMainSpecies();
//    d($rsCategories);
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsSpecies', $rsSpecies);
    $smarty->assign('pageTitle', 'Управление сайтом');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'admin');
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

function addnewspeciesAction(){
    $speciesName = $_POST['newSpeciesName'];
    $speciesParentId = $_POST['generalSpeciesId'];

    $res = insertSpecies($speciesName, $speciesParentId);
    $message0 = 'ощибка добавления категории';
    $message1 = 'категория добавлена';

    resDataJsonEncode($res, $message0, $message1);
}

/**
 * Страница управления категориями
 */
function categoryAction($smarty){
    $rsCategories = getAllCategories();
    $rsMainCategories = getAllMainCategories();
    $rsSpecies = getAllSpecies();
    $rsMainSpecies = getAllMainSpecies();

    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsMainCategories', $rsMainCategories);
    $smarty->assign('rsSpecies', $rsSpecies);
    $smarty->assign('rsMainSpecies', $rsMainSpecies);
    $smarty->assign('pageTitle', 'Управление сайтом');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminSpecies');
    loadTemplate($smarty, 'adminCategory');
    loadTemplate($smarty, 'adminFooter');
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

function productsAction($smarty){
    $rsCategories = getAllCategories();
    $rsProducts = getProducts();

    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsProducts', $rsProducts);

    $smarty->assign('pageTitle', 'Управление сайтом');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'adminProducts');
    loadTemplate($smarty, 'adminFooter');
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