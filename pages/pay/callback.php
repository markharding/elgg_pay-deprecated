<?php
/**
 * Callback for payment handler
 *
 * @package Pay
 */
 
elgg_load_library('elgg:pay');

elgg_set_context('pay_callback');

$order_guid = get_input('guid');
$order = get_entity($order_guid);

var_dump(pay_call_payment_handler_callback($order->payment_method, $order_guid));


echo 'MUST BE CALLED VIA AN IPN OR CALLBACK SERVICE';