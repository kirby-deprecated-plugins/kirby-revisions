<?php
namespace JensTornell\Revisions;
use f;

class Query {
	function part($query, $offset, $limit) {
		if( $query ) {
			$query = $this->all( $query );
			$query = $this->slice($query, $offset, $limit);
			return $query;
		}
	}

	function all($query) {
		if( $query ) {
			$query = $this->sort($query);
			$query = $this->lang($query);
			$query = $this->offset($query);
			return $query;
		}
	}

	function first($query) {
		if( $query ) {
			$query = $this->sort($query);
			$query = $this->lang($query);
			$query = $this->limit($query);
			return $query->first();
		}
	}

	function sort($query) {
		return $query->sortBy('modified', 'desc');
	}

	function lang($query) {
		$query = $query->filter(function($page) {
			$content = f::read( $page->textfile() );
			if( empty( $content ) ) {
				return false;
			}
			return true;
		});

		return $query;
	}

	function limit($query) {
		if( $query ) {
			return $query->limit(1);
		}
	}

	function offset($query) {
		if( $query ) {
			return $query->offset(1);
		}
	}

	function slice($query, $offset, $limit) {
		if( $query ) {
			return $query->slice($offset, $limit);
		}
	}
}