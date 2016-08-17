<?php
//use Kirby\Panel\Snippet;
use JensTornell\Revisions as Revisions;

class RevisionsField extends BaseField {
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
		$slice = array();
		$query = array();

		if( $this->page->find('revisions') ) {
			$query = $this->query();
			if( $query ) {
				$slice = $query->limit(3);

			}
		}

		$items = $this->items($slice);

		$html = tpl::load( __DIR__ . DS . 'template.php', $data = array(
			'field' => $this,
			'slice' => $slice,
			'query' => $query,
			'items' => $items
		));

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
		$query = $this->page->find('revisions')->children()->sortBy('modified', 'desc');

		if( $query ) {
			$query = $query->filter(function($page) {
				$content = f::read( $page->textfile() );
				if( empty( $content ) ) {
					return false;
				}
				return true;
			});

			return $query;
		}
	}
}