<?php
include_once("../include/config.php");

extract($_REQUEST);

$return_array = array();

if($_POST['token'] == API_TOKEN)
{

	if($kitchen_id > 0 && $order_id > 0){

		$exist =  $db->count("orders",array("status"=>1,'id'=>$order_id));

		if($exist == 0){

			//Update order status
			$update_array = array(
				"status"  => 1,
                "modifieddate"  => date("Y-m-d H:i:s"),
			);

			$db->update("orders",$update_array,array("id"=>$order_id));

			APIsuccess("You have accepted this order.");

		}else{
			APIError("This order has been already accepted.");
		}

	}else{
		APIError("Fill all required fields.");
	}	
}
else
{
	APIError("Token missing.");
}



