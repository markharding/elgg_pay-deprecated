<?php
/**
 * Pay - chout
 *
 * @package Pay
 */
elgg_load_library('elgg:pay');

$user_guid = elgg_get_logged_in_user_guid();
$user = get_entity($user_guid);

$basket = elgg_get_entities(array(
								'type' => 'object',
								'subtype' => 'pay_basket',
								'owner_guid' => $user_guid,
								));
								
$amount = pay_basket_total();
											
//We create a new order object								
$order = new ElggObject();
$order->subtype = 'pay';


foreach($basket as $item){
	$a->title = $item->title;
	$a->description = $item->description;
	$a->price = $item->price;
	$a->quantity = $item->quantity;
	$items[] = $a;
	$item->delete();
}
$order->items = serialize($items);


$order->amount = $amount;
$order->status = 'created';

$order->payment_method = 'paypal';

if($order->save()){
	return pay_call_payment_handler($order->payment_method, array( 'order_guid' => $order->getGuid(),
																   'user_guid' => $user_guid,
																   'amount' => $amount,
																   ));
} else {
	register_error(elgg_echo("pay:checkout:failed"));
}
