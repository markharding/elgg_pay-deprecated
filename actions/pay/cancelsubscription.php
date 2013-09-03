<?php

elgg_load_library('elgg:pay');

gatekeeper();

if ($order = get_entity(get_input('order_guid'))) {

    pay_cancel_recurring_payment($order->guid);
    
} else {
    register_error(elgg_echo("pay:cancel:failed"));
}