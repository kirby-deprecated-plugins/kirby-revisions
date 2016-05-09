<?php
use JensTornell\Revisions as Revisions;

class RevisionsField extends BaseField {
	static public $assets = array(
		'css' => array(
			'style.min.css',
		)
	);
	public function input() {
		require_once Revisions\Language::path();
		$path = Revisions\Folder::languagePath( $this->page()->id() );
		$revisions = array_reverse( glob( $path . DS . '*' ) );

		$html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
			'revisions' => $revisions,
			'page' => $this->page()
		));
		return $html;
	}
}