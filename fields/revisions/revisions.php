<?php
//use Kirby\Panel\Snippet;

class RevisionsField extends BaseField {
	static public $assets = array(
		'js' => array(
			'script.js',
		),
		'css' => array(
			'style.css',
		)
	);

	function input() {
		$slice = array();
		$query = array();

		if( $this->page->find('revisions') ) {
			$query = $this->query();
			if( $query ) {
				$slice = $query->limit(3);
			}
		}

		$html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
			'field' => $this,
			'slice' => $slice,
			'query' => $query
		));

		return $html;
	}

	function query() {
		$query = $this->page->find('revisions')->children()->sortBy('modified', 'desc');

		if( $query ) {
			$query = $query->filter(function($page) {
				$content = f::read( $page->textfile() );
				if( empty( $content ) ) {
					return false;
				}
				return true;
			});

			return $query;
		}
	}
}