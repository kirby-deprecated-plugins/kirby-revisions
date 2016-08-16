<?php
use JensTornell\Revisions as Revisions;

include __DIR__ . DS . 'pagination-class.php';

class RevisionarchiveField extends BaseField {
	static public $assets = array(
		'js' => array(
			'script.js',
		),
		'css' => array(
			'style.css',
		)
	);

	function input() {
		$this->get = 'revisions-page';
		$this->limit = 5;
		$this->PageNumbers = new Revisions\PageNumbers();
		$this->pageNumbers = (object)$this->pageNumbers();

		$html = '';
		$html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
			'field' => $this,
			'query' => $this->query(),
			'slice' => $this->query()->slice($this->pageNumbers->offset, $this->pageNumbers->limit)
		));
		$html .= $this->pageNumbersTemplate();

		return $html;
	}

	function query() {
		$query = $this->page->children()->sortBy('modified', 'desc');

		$query = $query->filter(function($page) {
			$content = f::read( $page->textfile() );
			if( empty( $content ) ) {
				return false;
			}
			return true;
		});

		return $query;
	}

	function pageNumbersTemplate() {
		return $this->PageNumbers->html($this->page, $this->query(), 'revisions-page', $this->limit);
	}

	function pageNumbers() {
		return $this->PageNumbers->get($this->page, $this->query(), $this->get, $this->limit);
	}
}