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
		$this->Collection = new Revisions\Collection();
		$this->get = 'revisions-page';
		$this->limit = 5;
		$this->PageNumbers = new Revisions\PageNumbers();
		$this->pageNumbers = (object)$this->pageNumbers();

		$slice = $this->query()->slice($this->pageNumbers->offset, $this->pageNumbers->limit);

		$html = '';
		$html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
			'field' => $this,
			'query' => $this->query(),
			'slice' => $slice,
			'items' => $this->items($slice)
		));
		$html .= $this->pageNumbersTemplate();

		return $html;
	}

	function items($slice) {
		$items = array();
		if( $slice ) {
			foreach( $slice as $key => $item ) {
				$items[$key] = array(
					'edit_url' => $this->editUrl($item),
					'modified' => $item->modified('Y-m-d, H:i:s'),
					'action' => ucfirst( (string)$item->revision_action() ),
					'template' => ucfirst( (string)$item->revision_template() ),
					'size' => $this->size($item),
				);
			}
		}
		return $items;
	}

	function editUrl($item) {
		return panel()->urls()->index() . '/pages/' . $item->id() . '/edit';
	}

	function size($item) {
		$collection = $item->content((string)site()->language())->toArray();
		$collection = $this->Collection()->revisionToPage($collection, $item->modified('Y-m-d, H:i:s'));

		$content = data::encode($collection, 'md');

		return strlen( $content );
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