<?php
namespace JensTornell\Revisions;

class ArraysManipulate {
	public $page_array;

	function __construct( $page_array = array(), $revision_array = array() ) {
		$this->page_array = $page_array;
	}

	function contentArray() {
		echo 'test';
//		print_r($this->page_array);
		/*$array = $this->page->content()->toArray();
		if( isset( $array['title'] ) ) {
			$array['revision_title'] = $array['title'];
			$array['title'] = $this->page->modified('Y-m-d, H:i:s');
		}
		return $array;*/
	}
}

// Manipulate array
class Collection {
	// Title to modified
	function titleToModified( $collection, $modified ) {
		if( isset( $collection['title'] ) ) {
			$collection['revision_title'] = $collection['title'];
			$collection['title'] = $modified;
		}
		return $collection;
	}

	// Add type
	function addType( $collection, $type ) {
		$collection['revision_type'] = $type;
		return $collection;
	}

	// Add template
	function addTemplate( $collection, $template ) {
		$collection['revision_template'] = $template;
		return $collection;
	}

	// Remove type
	function removeType( $collection ) {
		$collection['revision_type'] = null;
		return $collection;
	}

	// Remove template
	function removeTemplate( $collection ) {
		$collection['revision_template'] = null;
		return $collection;
	}

	// Modified to title
	function ModifiedToTitle( $collection ) {
		if( isset( $collection['revision_title'] ) ) {
			$collection['title'] = $collection['revision_title'];
			unset( $collection['revision_title'] );
		}
		return $collection;
	}

	// Array to content for comparation
	function arrayToContent( $array = array() ) {
		$content = '';
		if( ! empty( $array ) ) {
			foreach( $array as $key => $value ) {
				$content .= $key . ':' . $value . ' ';
			}
		}
		return substr( $content, 0, -1 );
	}

	function order( $keys, $collection ) {
		$new = array();
		foreach( $keys as $key ) {
			if( array_key_exists( $key, $collection ) ) {
				$new[$key] = $collection[$key];
			}
		}
		return $new;
	}
}