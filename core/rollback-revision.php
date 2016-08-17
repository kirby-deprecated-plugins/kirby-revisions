<?php
namespace JensTornell\Revisions;
use JensTornell\Revisions as Revisions;

class Rollback {
	function go($uid) {
		$this->Collection = new Revisions\Collection();

		$this->lang = get('lang');
		$this->uid = $uid;

		$this->revision = page($uid);
		$this->page = $this->revision->parent()->parent();

		$this->merged = $this->merge();
		$this->update( $this->merged );
	}

	function revision() {
		return page($this->uid);
	}

	function page() {
		return $this->revision->parent()->parent();
	}

	function pageCollection() {
		foreach( $this->page->content($this->lang)->toArray() as $key => $item ) {
			$keys[$key] = null;
		}
		return $keys;
	}

	function revisionCollection() {
		$collection = $this->revision->content( $this->lang )->toArray();
		$collection = $this->Collection->ModifiedToTitle( $collection, $this->page->modified('Y-m-d, H:i:s') );
		$collection = $this->Collection->removeAction( $collection );
		$collection = $this->Collection->removeTemplate( $collection );
		return $collection;
	}

	function merge() {
		return array_merge( $this->pageCollection(), $this->revisionCollection() );
	}

	function update() {
		return $this->page->update( $this->merge() );
	}
}