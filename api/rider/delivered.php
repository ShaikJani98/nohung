<?php
include_once("../include/config.php");

extract($_REQUEST);

$return_array = array();

if($_POST['token'] == API_TOKEN)
{

	if($userid > 0 && $orderid > 0){

		$order = $db->select('orders',array('id','deliverycharge'),array('riderid'=>$userid,'id'=>$orderid))->result();

		if($order['id'] > 0){

			$res = $db->pdoQuery("SELECT o.deliveryaddress,cu.mobilenumber,k.kitchencontactnumber,getDistance(k.latitude,k.longitude,r.latitude,r.longitude) as distance
	                              FROM orders as o 
						          LEFT JOIN user as k ON(k.id = o.userid)
								  LEFT JOIN user as cu ON(cu.id = o.customerid)
								  LEFT JOIN user as r ON(r.id = o.riderid)
							      WHERE o.id = ".$orderid."")->result();
			//echo print_r($res);exit;

			//Update delivery amount and points in rider wallet
			$sitesetting = $db->select('sitesetting',array('points_per_km'),array('id'=>1))->result();
			$points_gained = $sitesetting['points_per_km'] * round($res['distance']);
			$db->pdoQuery("update user set wallet = wallet + ".$order['deliverycharge'].",points_gained = points_gained + ".$points_gained." WHERE id = ".$userid."");

			//Update order status
			$update_array['status'] = 6;
			$update_array['points_gained'] = $points_gained;
			$update_array['delivery_time'] = date('Y-m-d H:i:s');
			$update_array['modifieddate'] = date('Y-m-d H:i:s');
			$db->update('orders',$update_array,array('id'=>$orderid));


			if(count($res) > 0)
			{
				
				$return_array[] = array(
					"deliveryaddress"=> $res['deliveryaddress'],
					"foodie_mobilenumber"=> $res['mobilenumber'] !='' ? $res['mobilenumber'] : '',
					"kitchen_mobilenumber"=> $res['kitchencontactnumber'] !='' ? $res['kitchencontactnumber'] : ''
				);

				APIsuccess("You delivered this order.",$return_array);
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



