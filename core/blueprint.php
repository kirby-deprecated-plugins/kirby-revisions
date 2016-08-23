<?php
namespace JensTornell\Revisions;
use JensTornell\Revisions as Revisions;
use yaml;

class Blueprint {
	function get($page, $revision) {
		$this->initClasses();

		$this->page_collection = $page->content($page->content()->language())->toArray();
		$this->revision_collection = $revision->content($revision->content()->language())->toArray();

		$this->blueprints = kirby()->get('blueprint');

		$this->fullpath = $this->fullpath($page->intendedTemplate());

		return $this->keys();
	}

	function initClasses() {
		$this->Path = new Revisions\Path();
	}

	// Path
	function fullpath($template) {
		$path = Revisions\Path::blueprintPath($template);
		$default = Revisions\Path::blueprintDefault();
		
		if( in_array($template, $this->blueprints) ) {
			$filepath = $this->blueprints[$template];
		} elseif( file_exists( $path . '.yml') ) {
			$filepath = $path . '.yml';
		} elseif( file_exists( $path . '.yaml' ) ) {
			$filepath = $path . '.yaml';
		} elseif( file_exists( $path . '.php' ) ) {
			$filepath = $path . '.php';
		} elseif( file_exists( $default . '.yml') ) {
			$filepath = $default . '.yml';
		} elseif( file_exists( $default . '.yaml' ) ) {
			$filepath = $default . '.yaml';
		} elseif( file_exists( $default . '.php' ) ) {
			$filepath = $default . '.php';
		}
		return $filepath;
	}

	// Data
	function data() {
		return yaml::read($this->fullpath);
	}

	// Keys
	function keys() {
		$data = $this->data();
		foreach( $data['fields'] as $key => $item ) {
			$keys[] = $key;
		}
		return $keys;
	}
}