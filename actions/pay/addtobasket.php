<?php
/**
 * Pay - add to basket action file
 * Creates an object with subtype pay_basket
 *
 * @package Pay
 */

// Get variables
$type_guid = get_input("type_guid");
$type = get_input($type_guid);

$title = get_input("title", $type->title ? $type->title : $type->name);
$desc = get_input("description", $type->description);
$price = get_input("price", $type->price);
$quantity = get_input("quantity", 1);
$user_guid = (int) elgg_get_logged_in_user_guid();

$item = new ElggObject();
$item->type = 'object';
$item->subtype = 'pay_basket';


$item->title = $title;
$item->description = $desc;
$item->quantity = $quantity;
$item->price = $price*$quantity;

$item->owner_guid = $user_guid;
$item->access_id = 0; 

if($item->save()){
	system_message(elgg_echo("pay:basket:item:add:success"));
} else {
	register_error(elgg_echo("pay:basket:item:add:failed"));
}

forward('pay/basket');