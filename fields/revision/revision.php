<?php
include __DIR__ . DS . '..' . DS . '..' . DS . 'filediff' . DS . 'filediff.php';

use JensTornell\Revisions as Revisions;

class RevisionField extends BaseField {
	public $page_obj;
	public $Blueprint;

	static public $assets = array(
		'js' => array(
			'script.js',
		),
		'css' => array(
			'style.css',
		)
	);

	function input() {
		$this->Collection = new Revisions\Collection();

		// Page
		$this->page_obj = $this->page->parent()->parent();
		$this->page_array = $this->page_obj->content()->toArray();

		// Revision
		$this->revision_obj = $this->page;
		$this->revision_array = $this->revision_obj->content()->toArray();

		$this->is_language = $this->isLanguage();

		// Blueprint
		$this->Blueprint = new Revisions\Blueprint($this->page_obj, $this->revision_obj);
		$this->keys = $this->Blueprint->keys();

		$this->page_array_fixed = $this->arrayFix( $this->page_array );
		$this->revision_array_fixed = $this->arrayFix( $this->revision_array );

		$this->items = $this->items();
		$this->changes = $this->changes();
		
		$html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
			'field' => $this,
			'items' => $this->items,
			'changes' => $this->changes,
			'language' => $this->is_language,
			'url' => $this->rollbackUrl()
		));

		return $html;
	}

	function rollbackUrl() {
		$csrf = s::get('csrf');
		$root = u();
		$key = 'revision.rollback';
		$id = $this->revision_obj->id();
		$lang = site()->language()->code();

		$url = $root . '/' . $key . '/' . $this->revision_obj->id() . '?csrf=' . $csrf . '&lang=' . $lang;

		return $url;
	}

	// Items
	function items() {
		$items = array();

		if( $this->is_language ) {
			foreach( $this->keys as $id => $key ) {
				$diff = '';
				$title = ucfirst( $key ) . ':';

				if( $this->isPage($key) ) {
					$diff = $this->diffPageRevisions($key);
				} elseif( array_key_exists( $key, $this->page_array_fixed ) && ! array_key_exists( $key, $this->revision_array_fixed ) ) {
					$title = '<del class="revision-del">' . $title . '</del>';
				} elseif( array_key_exists( $key, $this->revision_array_fixed ) && ! array_key_exists( $key, $this->page_array_fixed ) ) {
					$title = '<ins class="revision-ins">' . $title . '</ins>';
				}

				$items[] = array(
					'diff' => $diff,
					'title' => $title,
				);
			}
		}
		return $items;
	}

	// Is language
	function isLanguage() {
		return f::read( $this->revision_obj->textfile() );
	}

	// Changes
	function changes() {
		$changes['del'] = 0;
		$changes['ins'] = 0;
		$changes['total'] = 0;

		foreach( $this->items as $item ) {
			if( $this->stringInString( 'revision-del', $item['diff'] ) || $this->stringInString( 'revision-del', $item['title'] ) ) {
				$changes['del']++;
			}
			if( $this->stringInString( 'revision-ins', $item['diff'] ) || $this->stringInString( 'revision-ins', $item['title'] ) ) {
				$changes['ins']++;
			}

			if( $this->stringInString( 'revision-del', $item['diff'] ) || $this->stringInString( 'revision-ins', $item['diff'] ) ) {
				$changes['total']++;
			}

			if( $this->stringInString( 'revision-del', $item['title'] ) || $this->stringInString( 'revision-ins', $item['title'] ) ) {
				$changes['total']++;
			}
		}

		return $changes;
	}

	// String in string
	function stringInString($needle, $haystack) {
		$pos = strpos($haystack, $needle);
		if($pos === false) {
			return false;
		}
		else {
			return true;
		}
	}

	// Diff page revisions
	function diffPageRevisions($key) {
		return $this->diff( $this->page_array_fixed[$key], $this->revision_array_fixed[$key] );
	}

	// Is page
	function isPage($key) {
		if( ! empty( $this->page_array_fixed[$key] ) ) return true;
	}

	// Is revision
	function isRevision($key) {
		if( ! empty( $this->revision_array_fixed[$key] ) ) return true;
	}

	// Array fix
	function arrayFix( $collection ) {
		$collection = $this->Collection->ModifiedToTitle($collection);
		$collection = $this->Collection->order( $this->keys, $collection );
		return $collection;
	}

	// Diff
	public function diff( $from, $to ) {
		$opcodes = FineDiff::getDiffOpcodes( $from, $to );
		return nl2br( FineDiff::renderDiffToHTMLFromOpcodes($from, $opcodes) );
	}
}