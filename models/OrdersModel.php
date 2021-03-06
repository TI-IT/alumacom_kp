<?php

/**
 * Модель для таблицы заказов (orders)
 * 
 */

/**
 * Создание заказа (без привязки товара)
 * 
 * @param string $name
 * @param string $phone
 * @param string $adress
 * @return integer ID созданного заказа 
 */
function makeNewOrder($name, $phone, $adress)
{
	//> инициализация переменных
    $userId		=	$_SESSION['user']['id'];
	$comment	=	"id пользователя: {$userId}<br />
					Имя: {$name}<br />
					Тел: {$phone}<br />
					Адрес: {$adress}";
				
	$dateCreated	= date('Y.m.d H:i:s');
	$userIp			= $_SERVER['REMOTE_ADDR'];
	//<
	
	// формирование запроса к БД
	$sql = "INSERT INTO 
            orders (`user_id`, `date_created`, `date_payment`, 
					 `status`, `comment`, `user_ip`)  
           VALUES ('{$userId}', '{$dateCreated}', null, 
					'0', '{$comment}', '{$userIp}')";
    global $db;
   $rs = mysqli_query($db, $sql);
   
   // получить id созданного заказа
   if($rs){
       global $db;
	   $sql = "SELECT id 
				FROM orders 
				ORDER BY id DESC 
				LIMIT 1";
	   $rs = mysqli_query($db, $sql);
	   // преобразование результатов запроса
	   $rs = createSmartyRsArray($rs);
	   
	   // возвращаем id созданного запроса
	   if(isset($rs[0])){
		   return $rs[0]['id'];
	   }
   }
   
    return false;

}


/**
 * Получить список заказов с привязкой к продуктам для пользователя $userId
 * 
 * @param integer $userId ID пользователя
 * @return array массив заказов с привязкой к продуктам 
 */
function getOrdersWithProductsByUser($userId)
{	
	$userId = intval($userId);
	$sql = "SELECT * FROM orders
			WHERE `user_id` = '{$userId}'
			ORDER BY id DESC";
    global $db;
	$rs = mysqli_query($db, $sql);

	$smartyRs = array();
    while ($row = mysqli_fetch_assoc($rs)) {
       	$rsChildren = getPurchaseForOrder($row['id']);

        if($rsChildren){
            $row['children'] = $rsChildren;
			$smartyRs[] = $row;
        } 
    }
   
   return $smartyRs;	
}

function getOrders()
{
    global $db;
    $sql = "SELECT O.*, u.name, u.email, u.phone, u.adress
            FROM orders AS `o`
            LEFT JOIN users AS `u` ON o.user_id = u.id
            ORDER BY id DESC";

    $rs = mysqli_query($db, $sql);

    $smartyRs = array();
    while ($row = mysqli_fetch_assoc($rs)) {

        $rsChildren = getPurchaseForOrder($row['id']);

        if($rsChildren){
            $row['children'] = $rsChildren;
            $smartyRs[] = $row;
        }
    }
    return $smartyRs;
}

/**
 * Получить все продукты заказа
 * @return void
 */
function getProductsForOrder($orderId)
{
    global $db;
    $sql = "SELECT *
            FROM purchase AS pe
            LEFT JOIN products AS ps
                ON pe.product_id = ps.id
            WHERE (`order_id` = '{$orderId}')";

    $rs = mysqli_query($db, $sql);
    return createSmartyRsArray($rs);
}

function updateOrderStatus($itemId, $status)
{
    $status = intval($status);
    global $db;
    $sql = "UPDATE orders
    SET `status` = '{$status}'
        WHERE id = '{$itemId}'";

    $rs = mysqli_query($db, $sql);
    return $rs;
}

function updateOrderDatePayment($itemId, $datePayment)
{
    global $db;
    $sql = "UPDATE orders
            SET `date_payment` = '{$datePayment}'
            WHERE id = '{$itemId}'";

    $rs = mysqli_query($db, $sql);
    return $rs;
}