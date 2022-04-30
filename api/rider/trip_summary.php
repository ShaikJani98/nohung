<?php
include_once("../include/config.php");

extract($_REQUEST);

$return_array = array();

if($_POST['token'] == API_TOKEN)
{

	if($userid > 0 && $orderid > 0){

		$order = $db->select('orders',array('id'),array('riderid'=>$userid,'id'=>$orderid,'status'=>6))->result();

		if($order['id'] > 0){

			$res = $db->pdoQuery("SELECT o.start_delivery_time,o.delivery_time,o.deliverycharge,o.points_gained
	                              FROM orders as o 
						          WHERE o.id = ".$orderid." and o.status = 6")->result();
		    
			$date = date('Y-m-d');
			$today = $db->pdoQuery("SELECT sum(deliverycharge) as earnings_today
	                                FROM orders 
						            WHERE status = 6 and riderid = ".$userid." and DATE(delivery_time) = '".$date."'")->result();

			//print_r($today);exit;
			if(count($res) > 0)
			{
				
				$return_array[] = array(
					"delivery_duration"=> get_time_diff($res['start_delivery_time'],$res['delivery_time']),
					"trip_earning"=> $res['deliverycharge'],
					"point_gained"=> $res['points_gained'],
					"earnings_today"=> $today['earnings_today'] > 0 ? $today['earnings_today'] : ''

					
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



