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

//    d($rsCategories);
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('pageTitle', 'Управление сайтом');

    loadTemplate($smarty, 'adminHeader');
    loadTemplate($smarty, 'admin');
    loadTemplate($smarty, 'adminFooter');
}

function addnewcatAction(){
    $catName = $_POST['newCategoryName'];
    $catParentId = $_POST['generalCatId'];

    $res = insertCat($catName, $catParentId);
    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'категория добавлена';
    }else{
        $resData['success'] = 0;
        $resData['message'] = 'ощибка добавления категории';
    }

    echo json_encode($resData);
    return;
}

/**
 * Страница управления категориями
 */
function categoryAction($smarty){
    $rsCategories = getAllCategories();
    $rsMainCategories = getAllMainCategories();
    $smarty->assign('rsCategories', $rsCategories);
    $smarty->assign('rsMainCategories', $rsMainCategories);
    $smarty->assign('pageTitle', 'Управление сайтом');

    loadTemplate($smarty, 'adminHeader');
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

    if($res){
        $resData['success'] = 1;
        $resData['message'] = 'Категория обнавлена';
    }else{
        $resData['success'] = 0;
        $resData['message'] = 'Ощибка изменения данных категории';
    }

    echo json_encode($resData);
    return;
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