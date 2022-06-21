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
//Временное
function addproductimageAction($smarty){
    $rsProductsCount = countProducts()[0];
    $smarty->assign('rsProductsCount', $rsProductsCount);
    redirect('/admin/products/');
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

function setorderstatusAction(){
    $itemId = $_POST['itemId'];
    $status = $_POST['status'];

    $res = updateOrderStatus($itemId, $status);
    $message0 = 'Ошибка установки статуса';

    resDataJsonEncode($res, $message0);
}

function setorderdatepaymentAction(){
    $itemId = $_POST['itemId'];
    $datePayment = $_POST['datePayment'];

    $res = updateOrderDatePayment($itemId, $datePayment);
    $message0 = 'Ошибка установки статуса';

    resDataJsonEncode($res, $message0);
}

function createxmlAction(){
    $rsProducts = getProducts();

    $xml = new DOMDocument('1.0', 'utf-8');
    $xmpProducts = $xml->appendChild($xml->createElement('products'));

    foreach($rsProducts as $product){
        $xmpProducts = $xmpProducts->appendChild($xml->createElement('product'));
        foreach($product as $key => $val){
            $xmlName = $xmpProducts->appendChild($xml->createElement($key));
            $xmlName->appendChild($xml->createTextNode($val));
        }
    }

    $xml->save($_SERVER["DOCUMENT_ROOT"] . '/xml/products.xml');
    echo 'ok';
}

function uploadFile($localFilename, $localPath = '/upload/')
{
    $maxSize = 2 * 1024 * 1024;

    //Получаем расширение загружаемого файла
    $ext = pathinfo($_FILES['filename']['name'], PATHINFO_EXTENSION);

    //Создаем имя файла
    $pathInfo = pathinfo($localFilename);
    if($ext != $pathInfo['extension'])return false;

    $newFileName = $pathInfo['filename'] . '_' . time() . '.' . $pathInfo['extension'];

    if ($_FILES["filename"]["size"] > $maxSize) {
        return false;
    }

    $path = $_SERVER['DOCUMENT_ROOT'] . $localPath;
    if(! file_exists($path)){
        mkdir($path);
    }

    if(is_uploaded_file($_FILES['filename']['tmp_name'])){
        $res = move_uploaded_file($_FILES['filename']['tmp_name'], $path . $newFileName);
        return ($res == true) ? $newFileName : false;
    }
}

function loadfromxmlAction(){
    $successUploadFileName = uploadFile('import_products.xml', '/xml/import/');

    if(! $successUploadFileName){
        echo 'Ошибка загрузки файла';
        return;
    }

    $xmlFile = $_SERVER['DOCUMENT_ROOT'].'/xml/import/'.$successUploadFileName;
    $xmlProducts = simplexml_load_file($xmlFile);
    $products = array(); $i = 0;
    foreach($xmlProducts as $product){
        $products[$i]['name'] = htmlentities($product->name, ENT_QUOTES | ENT_IGNORE, "UTF-8");
        $products[$i]['category_id'] = intval($product->category_id);
        $products[$i]['description'] = htmlentities($product->description, ENT_QUOTES | ENT_IGNORE, "UTF-8");
        $products[$i]['price'] = intval($product->price);
        $products[$i]['status'] = intval($product->status);
        $i++;
    }
    $res = insertImportProducts($products);
    if($res){
        redirect('/admin/products/');
    }
}