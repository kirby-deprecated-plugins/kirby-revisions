<?php
namespace JensTornell\Revisions;
use tpl;

class PageNumbers {
	function get($page, $children, $name, $limit) {
		$this->page = $page;
		$this->children = $children;
		$this->name = $name;
		$this->limit = $limit;

		$this->pagination = array(
			'current' => $this->current(),
			'url' => $this->url(),
			'limit' => $this->limit,
			'offset' => $this->offset(),
			'total' => $this->total(),
			'showing' => $this->showing(),
			'prev' => $this->prev(),
			'prev_url' => $this->prevUrl(),
			'next' => $this->next(),
		);

		return $this->pagination;
	}

	function html($page, $children, $name, $limit) {
		$pagination = $this->get($page, $children, $name, $limit);
		$html = tpl::load( __DIR__ . DS . 'pagination-template.php', $data = array(
			'pagination' => (object)$pagination,
			'query' =>  $this->sliced()
		));

		return $html;
	}

	function current() {
		$page = get($this->name);
		return ( isset( $page ) ) ? $page : 1;
	}

	function sliced() {
		return $this->children->slice($this->offset(), $this->limit );
	}

	function offset() {
		return $this->limit * ( $this->current() - 1 );
	}

	function showing() {
		return $this->current() * $this->limit;
	}

	function total() {
		return $this->children->count();
	}

	function prev() {
		return ( $this->offset() > 0 ) ? true : false;
	}

	function prevUrl() {
		if( $this->prev() ) {
			return $this->url() . ( $this->current() - 1 );
		}
	}

	function next() {
		return ( $this->total() > $this->showing() ) ? true : false;
	}

	function url() {
		return panel()->urls()->index() . '/' . $this->page->kirby()->path() . '?' . $this->name .'=';
	}
}