<?php
use JensTornell\Revisions as Revisions;

class RevisionsField extends BaseField {
	static public $assets = array(
		'css' => array(
			'style.css',
		)
	);

	public $all;
	public $first;
	public $items;

	function input() {
		$this->init();

		$html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
			'all' => $this->all,
			'first' => $this->first,
			'rows' => $this->rows(),
			'footer' => $this->footer(),
			'headings' => $this->headings(),
		));
		return $html;
	}

	// Init
	function init() {
		$this->initClasses();
		if( $this->page->find('revisions') ) {
			$this->initQueries();
			$this->initData();
		}
	}

	// Init classes
	function initClasses() {
		$this->Collection = new Revisions\Collection();
		$this->Query = new Revisions\Query();
//		$this->Stat = new Revisions\Stat();
		$this->RevisionFieldClass = new Revisions\RevisionFieldClass();
	}

	// Init queries
	function initQueries() {
		$this->all = $this->Query->all( $this->page->find('revisions')->children() );
		$this->first = $this->Query->first( $this->page->find('revisions')->children() );
	}

	// Init data
	function initData() {
		$this->part = $this->Query->part($this->page->find('revisions')->children(), 0, 3);
		$this->items = $this->items($this->part);
	}

	// Items
	function items($part) {
		$items = array();
		if( $part ) {
			foreach( $part as $key => $item ) {
				$items[] = array(
					'edit' => Revisions\Url::edit( $item ),
					'modified' => $item->modified('Y-m-d, H:i:s'),
					'action' => $this->action( $item ),
					'template' => $this->templateName( $item ),
					//'stat' => $this->Stat->get($item, $item->content()->language()),
					'stats' => $this->RevisionFieldClass->get($item, $item->parent()->parent())
				);
			}
		}
		return $items;
	}

	// Headings
	function headings() {
		if( $this->items ) {
			return tpl::load( Revisions\Path::headings() );
		}
	}

	// Rows
	function rows() {
		if( $this->items ) {
			return tpl::load( Revisions\Path::rows(), $data = array(
				'items' => $this->items
			));
		}
	}

	// Footer
	function footer() {
		if( $this->first ) {
			return tpl::load( Revisions\Path::footer(), array(
				'slug' => $this->page->slug(),
				'flush' => $this->flush(),
				'edit' => $this->edit(),
				'revisions' => $this->revisions(),
				'modified' => $this->modified(),
				'count' => $this->all->count()
			));
		}
	}

	// Template
	function templateName( $item ) {
		return ucfirst( $item->revision_template() );
	}

	// Action
	function action( $item ) {
		return ucfirst( $item->revision_action() );
	}

	// Flush
	function flush() {
		return Revisions\Url::flush( $this->page );
	}

	// Edit
	function edit() {
		return Revisions\Url::edit( $this->first );
	}

	// Revisions
	function revisions() {
		return Revisions\Url::revisions( $this->page );
	}

	// Modified
	function modified() {
		return $this->first->modified('Y-m-d, H:i:s');
	}
}