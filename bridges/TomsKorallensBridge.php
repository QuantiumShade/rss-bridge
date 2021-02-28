<?php
class TomsKorallensBridge extends BridgeAbstract {

	const MAINTAINER = 'bg';
	const NAME = 'TomsKorallens';
	const URI = 'toms-korallen.de/shop/';
	const CACHE_TIMEOUT = 600; // 10min
	const DESCRIPTION = 'TomsKorallens';

	public function collectData(){
		$html = getSimpleHTMLDOM(self::URI)
			or returnServerError('Could not request TomsKorallens.');
//$html->find('.col-12.col-md-4.col-lg-4')
		foreach($html->find('.post-item') as $element) {
			$item = array();
			$temp = $element->find('h2.woocommerce-loop-product__title', 0);
			$titre = html_entity_decode($temp->innertext);
			$url = $element->find('a.woocommerce-loop-product__link', 0)->href;


	
			
			$image = $element->find('img', 0)->src;
			
			$tmp = $element->find('bdi', 0);
			$price = html_entity_decode($tmp->innertext);

			

		
			$item['content'] = '<img src="' . $image . '">';
	
			$item['uri'] = $url;
			$item['title'] = trim($titre) . ' | ' . trim($price);


			$this->items[] = $item;
		}
	}
}
