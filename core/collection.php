<?php
namespace JensTornell\Revisions;
use JensTornell\Revisions as Revisions;

class Collection {

	function __construct() {
		$this->Key = new Revisions\Key();
	}

	// Title to modified
	function titleToModified( $collection, $modified ) {
		if( isset( $collection['title'] ) ) {
			$collection['revision_title'] = $collection['title'];
			$collection['title'] = $modified;
		}
		return $collection;
	}

	// Add action
	function addAction( $collection, $action ) {
		$collection['revision_action'] = $action;
		return $collection;
	}

	// Add template
	function addTemplate( $collection, $template ) {
		$collection['revision_template'] = $template;
		return $collection;
	}

	// Remove action
	function removeAction( $collection ) {
		$collection['revision_action'] = null;
		return $collection;
	}

	// Remove template
	function removeTemplate( $collection ) {
		$collection['revision_template'] = null;
		return $collection;
	}

	// Revision to page
	function revisionToPage( $collection, $modified ) {
		$keys = $this->Key->all( $collection );
		$collection = $this->modifiedToTitle( $collection, $modified );
		$collection = $this->removeAction( $collection );
		$collection = $this->removeTemplate( $collection );
		return $collection;
	}

	// Modified to title
	function modifiedToTitle( $collection ) {
		if( isset( $collection['revision_title'] ) ) {
			$collection['title'] = $collection['revision_title'];
			unset( $collection['revision_title'] );
		}
		return $collection;
	}

	// Array to content for comparation
	function arrayToContent( $collection = array() ) {
		$content = '';
		if( ! empty( $collection ) ) {
			foreach( $collection as $key => $value ) {
				$content .= $key . ':' . $value . ' ';
			}
		}
		return substr( $content, 0, -1 );
	}
}