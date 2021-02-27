<?php
class FabcorailBridge extends BridgeAbstract {

	const MAINTAINER = 'bg';
	const NAME = 'Fabcorail';
	const URI = 'https://www.fabcorail.com/42-acropora';
	const CACHE_TIMEOUT = 300; // 5min
	const DESCRIPTION = 'Fabcorail';

	public function collectData(){
		$html = getSimpleHTMLDOM(self::URI)
			or returnServerError('Could not request Fabcorail.');

		foreach($html->find('div.product-container') as $element) {
			$item = array();
			$temp = $element->find('a.product-name', 0);
			$titre = html_entity_decode($temp->innertext);
			$url = $temp->href;


			$temp = $element->find('a.product_img_link', 0);

			// $images = $temp->find('img');

			// foreach($images as $image) {
			// 	$img_src = str_replace('.jpg', '.jpg', $image->src); 
			// 	$image->src = $img_src;
			// }
			
		
			$tmp = $element->find('span.price', 0);
			$price = html_entity_decode($tmp->innertext);

			$content = $temp->innertext;

			$item['content'] = trim($content) . ' | ' . trim($content);
			$item['uri'] = $url;
			$item['title'] = trim($titre) . ' | ' . trim($price);


			$this->items[] = $item;
		}
	}
}
