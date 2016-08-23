<?php
use JensTornell\Revisions as Revisions;

include __DIR__ . DS . 'pagination-class.php';

class RevisionarchiveField extends BaseField {
	static public $assets = array(
		'css' => array(
			'style.css',
		)
	);

	public $get = 'revisions-page';
	public $limit = 25;

	function input() {
		$this->init();

		$html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
			'all' => $this->all,
			'first' => $this->first,
			'rows' => $this->rows(),
			'footer' => $this->footer(),
			'headings' => $this->headings(),
		));
		return $html . $this->pageNumbersTemplate();
	}

	// Init
	function init() {
		$this->initClasses();
		$this->initQueries();
		$this->initPageNumbers();
		$this->initData();
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
		$this->all = $this->Query->all( $this->page->children() );
		$this->first = $this->Query->first( $this->page->children() );
	}

	// Init page numbers
	function initPageNumbers() {
		$this->PageNumbers = new Revisions\PageNumbers();
		$this->pageNumbers = (object)$this->pageNumbers();
		$this->offset = $this->pageNumbers->offset;
	}

	// Init data
	function initData() {
		$this->part = $this->Query->part($this->page->children(), $this->offset, $this->limit);
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
					//'size' => $this->size($item),
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
				'modified' => $this->modified()
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
		return Revisions\Url::flush( $this->page->parent() );
	}

	// Edit
	function edit() {
		return Revisions\Url::edit( $this->first );
	}

	// Modified
	function modified() {
		return $this->first->modified('Y-m-d, H:i:s');
	}

	// Page numbers template
	function pageNumbersTemplate() {
		return $this->PageNumbers->html($this->page, $this->all, $this->get, $this->limit);
	}

	// Page numbers
	function pageNumbers() {
		return $this->PageNumbers->get($this->page, $this->all, $this->get, $this->limit);
	}
}