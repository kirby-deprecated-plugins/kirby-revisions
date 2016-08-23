<?php
use JensTornell\Revisions as Revisions;

class RevisionField extends BaseField {
	public $page_obj;
	public $Blueprint;

	static public $assets = array(
		'css' => array(
			'style.css',
		),
		'js' => array(
			'script.js'
		),
	);

	function input() {
		$this->RevisionFieldClass = new Revisions\RevisionFieldClass();

		$html = $this->RevisionFieldClass->getHtml(
			$this->page->parent()->parent(),
			$this->page
		);

		return $html;
	}

	public function element() {
		$element = parent::element();
		$element->data('field', 'revision');
		return $element;
	}
}