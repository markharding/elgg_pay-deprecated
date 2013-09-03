<?php
/**
 * Pay - withdraw funds from a users account
 *
 * @package Pay
 */
elgg_load_library('elgg:pay');

admin_gatekeeper();

$withdraw_guid = get_input('guid');
$withdraw = get_entity($withdraw_guid);

//do a check to make sure that we are not giving the user money than they are suppose to have!
if($withdraw->amount > pay_get_user_balance($withdraw->seller_guid)){
	register_error(elgg_echo("pay:withdraw:insufficientfunds"));
	forward();
}

$withdraw->status = 'Completed';

if($withdraw->save()){
	system_message(elgg_echo("pay:admin:withdraw:success"));
	notification_create(array($withdraw->seller_guid), elgg_get_logged_in_user_guid(), $withdraw->guid, array('notification_view'=>'pay_withdraw'));
	
} else {
	register_error(elgg_echo("pay:admin:withdraw:failed"));
}

forward(REFERRER);