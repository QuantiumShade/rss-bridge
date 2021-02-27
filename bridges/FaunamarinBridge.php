<?php
class FaunamarinBridge extends BridgeAbstract {

	const MAINTAINER = 'bg';
	const NAME = 'Faunamarin';
	const URI = 'https://www.faunamarincorals.de/en/animals/wysiwyg';
	const CACHE_TIMEOUT = 300; // 5min
	const DESCRIPTION = 'Fauna marin';

	public function collectData(){
		$html = getSimpleHTMLDOM(self::URI)
			or returnServerError('Could not request Fauna marin.');

		foreach($html->find('li.col-12 col-md-4 col-lg-4') as $element) {
			$item = array();
			$temp = $element->find('a.thumb-title', 0);
			$titre = html_entity_decode($temp->innertext);
			$url = $temp->href;

			$temp = $element->find('div.thumb-image', 0);
			// retrieve .gif instead of static .jpg
			$images = $temp->find('picture');

			foreach($images as $image) {
				$img_src = str_replace('.jpg', '.jpg', $image->src);
				$image->src = $img_src;
			}
			
		
			$tmp = $element->find('a.price', 0);
			$price = html_entity_decode($tmp->innertext);

			$content = $temp->innertext;

			$item['content'] = trim($content);
			$item['uri'] = $url;
			$item['title'] = trim($titre) . ' | ' . trim($price);


			$this->items[] = $item;
		}
	}
}
