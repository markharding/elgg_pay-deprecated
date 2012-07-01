<?php
/**
 * Pay - see account overview
 *
 * @package Pay
 */
elgg_load_library('elgg:pay');

//elgg_set_context('settings');

pay_breadcrumb();

elgg_push_breadcrumb(elgg_echo('pay:account'), 'pay/account');


$limit = get_input("limit", 10);

$title = elgg_echo('pay:account');


$content = elgg_list_entities(array(
	'types' => 'object',
	'subtypes' => 'pay',
	'limit' => $limit,
	'full_view' => FALSE,
	
));

$content .= pay_basket_add_button(null, 'A test item', 'a test description', 100, 1);

if (!$content) {
	$content = elgg_echo('pay:account:none');
}

$body = elgg_view_layout('content', array(
	'filter' => '',
	'content' => $content,
	'title' => $title,
	'sidebar' => $sidebar,
));


echo elgg_view_page($title, $body);

?>