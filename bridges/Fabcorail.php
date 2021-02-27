<?php
class Fabcorail extends BridgeAbstract {

	const MAINTAINER = 'bg';
	const NAME = 'Fabcorail';
	const URI = 'https://www.fabcorail.com/42-acropora';
	const CACHE_TIMEOUT = 7200; // 2h
	const DESCRIPTION = 'Fabcorail';

	public function collectData(){
		$html = getSimpleHTMLDOM(self::URI)
			or returnServerError('Could not request Fabcorail.');

		foreach($html->find('div.product-container') as $element) {
			$item = array();
			$temp = $element->find('a.product-name', 0);
			$titre = html_entity_decode($temp->innertext);
			$url = $temp->href;

			$temp = $element->find('div.left-block', 0);
			$temp = $element->find('div.product-image-container', 0);
			// retrieve .gif instead of static .jpg
			$images = $temp->find('img');
			foreach($images as $image) {
				$img_src = str_replace('.jpg', '.gif', $image->src);
				$image->src = $img_src;
			}

			$content = $temp->innertext;

			$item['content'] = trim($content);
			$item['uri'] = $url;
			$item['title'] = trim($titre);

			$this->items[] = $item;
		}
	}
}
