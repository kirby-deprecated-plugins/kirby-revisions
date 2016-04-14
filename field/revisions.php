<?php
class RevisionsField extends BaseField {
	public function input() {
		require_once RevisionsLanguage::path();
		$path = RevisionsFolder::languagePath( $this->page()->id() );
		$revisions = array_reverse( glob( $path . DS . '*' ) );

		$html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
			'revisions' => $revisions,
			'page' => $this->page()
		));
		return $html;
	}
}