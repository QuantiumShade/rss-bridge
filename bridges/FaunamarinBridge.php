<?php
class FaunamarinBridge extends BridgeAbstract {

	const MAINTAINER = 'bg';
	const NAME = 'FaunamarinBridge';
	const URI = 'https://www.faunamarincorals.de/en/animals/wysiwyg';
	const CACHE_TIMEOUT = 300; // 5min
	const DESCRIPTION = 'FaunamarinBridge';

	public function collectData(){
		$html = getSimpleHTMLDOM(self::URI)
			or returnServerError('Could not request FaunamarinBridge.');

		foreach($html->find('div.thumb-inner') as $element) {
			$item = array();
			$temp = $element->find('a.thumb-title', 0);
			$titre = html_entity_decode($temp->innertext);
			$url = $temp->href;


			// $temp = $element->find('img');
			// $top = array();

			// foreach($element->find('a.product_img_link > img') as $test) {
			// 	$top=$test;
			// }
           
			// $temp = $element->find('a.product_img_link img', 0);
	
			// $images = $temp->find('img');

			// foreach($images as $image) {
			// 	$img_src = str_replace('.jpg', '.jpg', $image->src); 
			// 	$image->src = $img_src;
			// }
			
			$tmp = $element->find('a.price', 0);
			$price = html_entity_decode($tmp->innertext);

			

			$item['content'] = 'default';
	
			$item['uri'] = $url;
			$item['title'] = trim($titre) . ' | ' . trim($price);


			$this->items[] = $item;
		}
	}
}
