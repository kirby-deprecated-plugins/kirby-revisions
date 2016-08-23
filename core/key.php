<?php
namespace JensTornell\Revisions;
use JensTornell\Revisions as Revisions;

class Key {

	function __construct() {
		$this->Blueprint = new Revisions\Blueprint();
	}

	// All keys
	function all( $collection ) {
		$keys = array();
		if( ! empty( $collection ) ) {
			foreach( $collection as $key => $item ) {
				if( isset( $item ) ) {
					$keys[] = $key;
				}
			}
		}
		return $keys;
	}

	// Merge keys
	function merge($collection1, $collection2) {
		$keys1 = $this->all( $collection1 );
		$keys2 = $this->all( $collection2 );
		$keys = array_unique( array_merge( $keys1, $keys2 ), SORT_REGULAR);
		return $keys;
	}

	// Missing keys
	function missing($needle_collection, $haystack_collection) {
		return array_diff($haystack_collection, $needle_collection);
	}

	function total($p, $r) {
		$blueprint_keys = $this->Blueprint->get( $p, $r );
		$blueprint_keys = array_combine($blueprint_keys, $blueprint_keys);

		$p_collection = $p->content($p->content()->language())->toArray();
		$r_collection = $r->content($r->content()->language())->toArray();

		$a_collection = array_merge($r_collection, $p_collection);
		unset(
			$a_collection['revision_title'],
			$a_collection['revision_action'],
			$a_collection['revision_template']
		);

		foreach( $blueprint_keys as $key ) {
			if( array_key_exists( $key, $a_collection ) ) {
				unset( $a_collection[$key] );
			}
		}

		$total = array_merge($blueprint_keys, $a_collection);
		
		return $total;
	}
}