<?php

elgg_load_library('elgg:pay');

$currency = elgg_get_plugin_setting('currency', 'pay');
$body .= elgg_echo('pay:settings:currency');
$body .= '<br />';
$body .= elgg_view('input/text',array('name'=>'params[currency]','value'=>$currency));
$body .= '<br />';

$body .= '<br />';
$body .= '<h3>' . elgg_echo('pay:settings:enabled_payment_handlers') . '</h3>';

$body .= '<br />';
	global $CONFIG;
	$handlers = $CONFIG->pay['payment_handlers'];
	foreach($handlers as $k => $v){
		$enabled = elgg_get_plugin_setting('enabled_payment_handlers_' . $k , 'pay') ? 'on' : false;	
		
		$body .= $k;
			
		$body .= elgg_view("input/checkbox", array(
														'name' => 'params[enabled_payment_handlers_' . $k .']',
														//'default' => $enabled,
														'checked' => $enabled
													
													));

	}
$body .= '<br />';

/* PayPal handler settings
 */
$body .= '<br />';
$body .= '<h3>PayPal settings</h3>';
$paypal_business_email = elgg_get_plugin_setting('paypal_business', 'pay');
$body .= elgg_echo('pay:paypal:business');
$body .= '<br />';
$body .= elgg_view('input/text',array('name'=>'params[paypal_business]','value'=>$paypal_business_email));
$body .= '<br />';


$paypal_api_username = elgg_get_plugin_setting('paypal_api_username', 'pay');
$body .= elgg_echo('pay:paypal:api:username');
$body .= '<br />';
$body .= elgg_view('input/text',array('name'=>'params[paypal_api_username]','value'=>$paypal_api_username));
$body .= '<br />';

$paypal_api_password = elgg_get_plugin_setting('paypal_api_password', 'pay');
$body .= elgg_echo('pay:paypal:api:password');
$body .= '<br />';
$body .= elgg_view('input/text',array('name'=>'params[paypal_api_password]','value'=>$paypal_api_password));
$body .= '<br />';


$paypal_api_signature = elgg_get_plugin_setting('paypal_api_signature', 'pay');
$body .= elgg_echo('pay:paypal:api:signature');
$body .= '<br />';
$body .= elgg_view('input/text',array('name'=>'params[paypal_api_signature]','value'=>$paypal_api_signature));
$body .= '<br />';


echo $body;
