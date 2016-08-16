<?php
namespace JensTornell\Revisions;

class CreateRevisions {
	public $page;
	public $id;

	function __construct( $page ) {
		$this->page = $page;
		$this->id = $page->id() . '/' . 'revisions';
		$this->add = $this->add();
	}

	function add() {
		if( $this->has() ) return false;
		if( $this->is() ) return false;

		page()->create($this->id, 'revisionarchive', array(
			'title' => 'Revisions',
		));
	}

	// Is revision
	function is() {
		if( $this->page->slug() == 'revisions' ) return true;
		if( $this->page->parents()->toArray() ) {
			$parents = $this->page->parents();
			foreach( $parents as $parent ) {
				if( $parent->slug() == 'revisions') return true;
			}
		}
	}

	function has() {
		if( page( $this->id ) ) return true;
	}
}