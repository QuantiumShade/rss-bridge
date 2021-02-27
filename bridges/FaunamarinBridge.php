<?php
class FaunamarinBridge extends BridgeAbstract {

	const MAINTAINER = 'bg';
	const NAME = 'FaunamarinBridge';
	const URI = 'toms-korallen.de/shop/';
	const CACHE_TIMEOUT = 300; // 5min
	const DESCRIPTION = 'FaunamarinBridge';

	public function collectData(){
		$html = getSimpleHTMLDOM(self::URI)
			or returnServerError('Could not request FaunamarinBridge.');
//$html->find('.col-12.col-md-4.col-lg-4')
		foreach($html->find('.post-item') as $element) {
			$item = array();
			$temp = $element->find('h2.woocomerce-loop-product__title', 0);
			$titre = html_entity_decode($temp->innertext);
			$url = $temp->href;


	
			
			$image = $element->find('img', 0)->src;
			
			$tmp = $element->find('span.price', 0);
			$price = html_entity_decode($tmp->innertext);

			

		
			$item['content'] = '<img src="' . $image . '">';
	
			$item['uri'] = $url;
			$item['title'] = trim($titre) . ' | ' . trim($price);


			$this->items[] = $item;
		}
	}
}
