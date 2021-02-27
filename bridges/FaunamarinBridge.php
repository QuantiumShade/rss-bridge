<?php
class FaunamarinBridge extends BridgeAbstract {

	const MAINTAINER = 'bgd';
	const NAME = 'Eurocorals';
	const URI = 'https://www.eurocorals.com/shop/';
	const CACHE_TIMEOUT = 300; // 5min
	const DESCRIPTION = 'Eurocorals';

	$html = getSimpleHTMLDOM(self::URI)
	or returnServerError('Could not request Fabcorail.');

foreach($html->find('div.product-small') as $element) {
	$item = array();
	$temp = $element->find('a.woocommerce-LoopProduct-link', 0);
	$titre = html_entity_decode($temp->innertext);
	$url = $temp->href;


	$temp = $element->find('container-image-and-badge img', 0);
	

	// $images = $temp->find('img');

	// foreach($images as $image) {
	// 	$img_src = str_replace('.jpg', '.jpg', $image->src); 
	// 	$image->src = $img_src;
	// }

	$content = $temp;
	
	$tmp = $element->find('bdi', 0);
	$price = html_entity_decode($tmp->innertext);

	

	$item['content'] = $content;
	$item['uri'] = $url;
	$item['title'] = trim($titre) . ' | ' . trim($price);


	$this->items[] = $item;
}
}
}
