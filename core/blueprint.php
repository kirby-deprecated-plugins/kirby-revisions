<?php
namespace JensTornell\Revisions;
use JensTornell\Revisions as Revisions;
use yaml;

class Blueprint {
	public $template;
	public $path;
	public $blueprints;
	public $defaultpath;
	public $dirpath;

	function __construct( $page_obj, $revision_obj ) {
		$this->page_obj = $page_obj;
		$this->page_array = $this->page_obj->content()->toArray();

		$this->revision_obj = $page_obj;
		$this->revision_array = $this->revision_obj->content()->toArray();

		$this->template = $this->page_obj->intendedTemplate();
		
		$this->blueprints = $this->blueprints();
		$this->defaultpath = $this->defaultpath();
		$this->dirpath = $this->dirpath();
		$this->path = $this->path();
		$this->data = $this->data();
	}

	// Blueprints
	function blueprints() {
		return kirby()->get('blueprint');
	}

	// Dir path
	function dirpath() {
		return kirby()->roots()->blueprints() . DS . $this->template;
	}

	// Default path
	function defaultPath() {
		return kirby()->roots()->blueprints() . DS . 'default';
	}

	// Path
	function path() {
		if( in_array($this->template, $this->blueprints) ) {
			$filepath = $this->set_blueprints[$this->template];
		} elseif( file_exists( $this->dirpath . '.yml') ) {
			$filepath = $this->dirpath . '.yml';
		} elseif( file_exists( $this->dirpath . '.yaml' ) ) {
			$filepath = $this->dirpath . '.yaml';
		} elseif( file_exists( $this->dirpath . '.php' ) ) {
			$filepath = $this->dirpath . '.php';
		} elseif( file_exists( $this->defaultpath . '.yml') ) {
			$filepath = $this->defaultpath . '.yml';
		} elseif( file_exists( $this->defaultpath . '.yaml' ) ) {
			$filepath = $this->defaultpath . '.yaml';
		} elseif( file_exists( $this->defaultpath . '.php' ) ) {
			$filepath = $this->defaultpath . '.php';
		}
		return $filepath;
	}

	// Data
	function data() {
		return yaml::read($this->path);
	}

	// Keys
	function keys() {
		foreach( $this->data['fields'] as $key => $item ) {
			if( isset( $this->page_array[$key] ) || isset( $this->revision_array[$key] ) ) {
				$keys[] = $key;
			}
		}
		return $keys;
	}
}