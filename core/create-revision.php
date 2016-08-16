<?php
namespace JensTornell\Revisions;
use JensTornell\Revisions as Revisions;

class CreateRevision {
	public $page;
	public $collection;
	public $id;
	public $type;

	function go($page, $type, $lang) {
		$this->Collection = new Revisions\Collection();

		$this->lang = (string)$lang;
		$this->type = $type;
		$this->page = $page;
		$this->collection = $page->content($this->lang)->toArray();
		$this->template = $page->intendedTemplate();
		$this->id = $this->page->id() . '/' . 'revisions' . '/r-' . time() . '-' . $type;

		$this->create();
	}

	function create() {
		if( ! $this->valid() ) return false;

		page()->create($this->id, 'revision', array() );
		page($this->id)->update( $this->filter($this->collection), $this->lang );
	}

	function valid() {
		if( $this->has() ) return false;
		if( $this->is() ) return false;
		return true;
	}

	function filter($collection) {
		$collection = $this->Collection->titleToModified( $this->collection, $this->page->modified('Y-m-d, H:i:s') );
		$collection = $this->Collection->addType( $collection, $this->type );
		$collection = $this->Collection->addTemplate( $collection, $this->template );
		return $collection;
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

	// Has revision
	function has() {
		if( page( $this->id ) ) return true;
	}
}