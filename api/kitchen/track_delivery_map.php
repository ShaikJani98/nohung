<?php
include_once("../include/config.php");

extract($_REQUEST);

$return_array = array();

if($_POST['token'] == API_TOKEN)
{

	if($kitchen_id > 0 && $order_id > 0){

		$order = $db->select('orders',array('id'),array('userid'=>$kitchen_id,'id'=>$order_id))->result();

		if($order['id'] > 0){

			$res = $db->pdoQuery("SELECT o.deliveryaddress,k.latitude as kitchenlatitude,k.longitude as kitchenlongitude,o.deliverylatitude,o.deliverylongitude
	                              FROM orders as o 
						          LEFT JOIN user as k ON(k.id = o.userid)
							      WHERE o.id = ".$order_id."")->result();
			
			if(!empty($res))
			{
				
				$return_array[] = array(
					"kitchenlatitude"=> $res['kitchenlatitude'],
					"kitchenlongitude"=> $res['kitchenlongitude'],
					"deliverylatitude"=> $res['deliverylatitude'],
					"deliverylongitude"=> $res['deliverylongitude'],
					"deliveryaddress"=> $res['deliveryaddress']
				);

				APIsuccess("success",$return_array);
			}
			else
			{
				APIError("Order not found.");
			}

		}else{
			APIError("Invalid order.");
		}

	}else{
		APIError("Fill all required fields.");
	}	
}
else
{
	APIError("Token missing.");
}