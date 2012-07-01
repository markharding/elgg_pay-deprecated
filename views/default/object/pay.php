<?php
/**
 * Pay - pay order object view
 *
 * @package Pay
 */
elgg_load_library('elgg:pay'); 

$full = elgg_extract('full_view', $vars, FALSE);
$order = elgg_extract('entity', $vars, FALSE);


if (!$order) {
	return TRUE;
}

$metadata = elgg_view_menu('entity', array(
	'entity' => $vars['entity'],
	'handler' => 'pay',
	'sort_by' => 'priority',
	'class' => 'elgg-menu-hz',
));

if($full){
	
	echo '<div>';
	echo elgg_echo('pay:account:order:status') . elgg_echo('pay:account:order:status:' .$order->status);
	echo '</div><br/>';
	
	$items = unserialize($order->items);
	$currency = pay_get_currency();
	
	foreach($items as $item){
		echo '<div>';
			echo '<b>' . $item->title . '</b> ';
			echo '<i>x' . $item->quantity . '</i> ';
			echo  '' . $currency['symbol'] . $item->price;
		echo '</div>';	
	}
	echo '<br/><div><b>Total: </b>' . $currency['symbol'] . $order->amount . '</div>';

	
	
} else {

	$params = array(
		'entity' => $order,
		'metadata' => $metadata,
		'title' => elgg_view('output/url', array('text' => elgg_echo('pay:account:order') . ': ' . $order->guid, 'href'=>$order->getUrl())),
		'subtitle' => elgg_get_friendly_time($order->time_created),
		'content' => '',
	);
	
	$params = $params + $vars;
	$list_body = elgg_view('object/elements/summary', $params);

	echo elgg_view_image_block(null, $list_body);

}