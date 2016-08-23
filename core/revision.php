<?php
namespace JensTornell\Revisions;

use JensTornell\Revisions as Revisions;
use FineDiff;
use tpl;
use f;

class RevisionFieldClass {
	function get($page, $revision) {
		$this->p = $page;
		$this->r = $revision;

		$this->init();

		return $this->items();
	}

	function getHtml($page, $revision) {
		$this->items = $this->get($page, $revision);
		return $this->html();
	}

	// Init
	function init() {
		$this->initClasses();
		$this->initCollections();
		$this->initQueries();
	}

	// Init classes
	function initClasses() {
		$this->Collection = new Revisions\Collection();
		$this->Misc = new Revisions\Misc();
		$this->Blueprint = new Revisions\Blueprint();
		$this->Key = new Revisions\Key();
	}

	// Init collections
	function initCollections() {
		$this->p_collection = $this->p->content($this->p->content()->language())->toArray();
		$this->r_collection = $this->r->content($this->r->content()->language())->toArray();
	}

	// Init queries
	function initQueries() {
		$this->blueprint_keys = $this->Blueprint->get( $this->p, $this->r );
		$this->total = $this->Key->total( $this->p, $this->r );

		$this->p_collection = $this->Collection->revisionToPage(
			$this->p_collection,
			$this->p->modified('Y-m-d, H:i:s')
		);
		$this->r_collection = $this->Collection->revisionToPage(
			$this->r_collection,
			$this->r->modified('Y-m-d, H:i:s'),
			$this->blueprint_keys
		);
	}

	// Items
	function items() {
		$items = array();

		if( ! $this->hasLanguage() ) return array();

		$items['titles_del'] = 0;
		$items['titles_ins'] = 0;
		$items['page_fields'] = count( $this->p_collection );
		$items['revision_fields'] = count( $this->r_collection );
		$items['blueprint_fields'] = count( $this->blueprint_keys );
		$items['values_del'] = 0;
		$items['values_ins'] = 0;
		$items['revision_blueprint_diff'] = $this->revisionBlueprintDiff();
		$items['page_blueprint_diff'] = $this->pageBlueprintDiff();

		$i = 0;
		foreach( $this->total as $key => $item ) {
			$items['values'][$key]['value'] = '';
			$items['values'][$key]['title'] = ucfirst( $key ) . ':';

			if( $this->hasPageValue($key) && $this->hasRevisionValue($key) ) {
				$items['values'][$key]['value'] = $this->diffPageRevisions($key);
				$items['values_del'] += $this->diffDelCount( $items['values'][$key]['value'] );
				$items['values_ins'] += $this->diffInsCount( $items['values'][$key]['value'] );
			} elseif( $this->hasOnlyPageData( $key ) ) {
				$items['values'][$key]['value'] = '<del class="revision-del">' . $this->p_collection[$key] . '</del>';
				$items['values'][$key]['title'] = '<del class="revision-del">' . $items['values'][$key]['title'] . '</del>';
				$items['titles_del'] ++;
			} elseif( $this->hasOnlyRevisionData( $key ) ) {
				$items['values'][$key]['value'] = '<ins class="revision-ins">' . $this->r_collection[$key] . '</ins>';
				$items['values'][$key]['title'] = '<ins class="revision-ins">' . $items['values'][$key]['title'] . '</ins>';
				$items['titles_ins'] ++;
			}
			$i++;
		}
		$items['ins_total'] = $items['values_ins'] + $items['titles_ins'];
		$items['del_total'] = $items['values_del'] + $items['titles_del'];
		$items['titles_total'] = $items['titles_del'] + $items['titles_ins'];
		$items['values_total'] = $items['values_del'] + $items['values_ins'];
		$items['total'] = $items['titles_total'] + $items['values_total'];

		$items['template_equal'] = false;

		if( $this->p->intendedTemplate() == $this->r->revision_template() ) {
			$items['template_equal'] = true;
		}

		return $items;
	}

	// Items missing in blueprint
	function itemsMissingInBlueprint() {
		$items = array();
		if( ! empty( $this->items['values'] ) ) {
			foreach( $this->items['values'] as $key => $item ) {
				if( ! in_array( $key, $this->blueprint_keys ) ) {
					$items[$key]['title'] = $item['title'];
					if( ! empty( $item['value'] ) ) {
						$items[$key]['value'] = $item['value'];
					}
				}
			}
		}
		return $items;
	}

	// Revision blueprint diff
	function revisionBlueprintDiff() {
		$missing = 0;
		foreach( $this->blueprint_keys as $key ) {
			if( ! array_key_exists( $key, $this->r_collection ) ) {
				$missing++;
			}
		}
		return $missing;
	}

	// Page blueprint diff
	function pageBlueprintDiff() {
		$missing = 0;
		foreach( $this->blueprint_keys as $key ) {
			if( ! array_key_exists( $key, $this->p_collection ) ) {
				$missing++;
			}
		}
		return $missing;
	}

	// Diff del count
	function diffDelCount( $value ) {
		return $this->Misc->stringInString( 'revision-del', $value );
	}

	// Diff ins count
	function diffInsCount( $value ) {
		return $this->Misc->stringInString( 'revision-ins', $value );
	}

	// Html
	function html() {
		$html = tpl::load(
			kirby()->roots()->plugins() . DS . 'kirby-revisions' . DS . 'fields' . DS . 'revision' . DS . 'template.php',
			$data = array(
				'items' => $this->items,
				'language' => $this->hasLanguage(),
				'rollback_url' => Revisions\Url::rollback($this->r),
				'delete_url' => Revisions\Url::delete($this->r),
				'revision' => $this->r,
				'page' => $this->p,
				'blueprint_keys' => $this->blueprint_keys,
				'items_missing_in_blueprint' => $this->itemsMissingInBlueprint()
		));

		return $html;
	}

	function hasLanguage() {
		return f::read( $this->r->textfile() );
	}

	// Has only page data
	function hasOnlyPageData( $key ) {
		if( ! array_key_exists( $key, $this->p_collection ) ) return false;
		if( array_key_exists( $key, $this->r_collection ) ) return false;

		return true;
	}

	// Has only revision data
	function hasOnlyRevisionData( $key ) {
		if( array_key_exists( $key, $this->p_collection ) ) return false;
		if( ! array_key_exists( $key, $this->r_collection ) ) return false;

		return true;
	}

	// Has page value
	function hasPageValue($key) {
		if( ! empty( $this->p_collection[$key] ) ) return true;
	}

	// Has revision value
	function hasRevisionValue($key) {
		if( ! empty( $this->r_collection[$key] ) ) return true;
	}

	// Diff page revisions
	function diffPageRevisions($key) {
		return $this->diff( $this->p_collection[$key], $this->r_collection[$key] );
	}

	// Diff
	public function diff( $from, $to ) {
		$opcodes = FineDiff::getDiffOpcodes( $from, $to );
		return nl2br( FineDiff::renderDiffToHTMLFromOpcodes($from, $opcodes) );
	}
}