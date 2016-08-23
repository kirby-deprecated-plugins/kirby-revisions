<?php
namespace JensTornell\Revisions;
use s;

class Url {	
	public static function flush($page) {
		return u() . '/revisions.delete.all/' . $page->id() . '/?csrf=' . s::get('csrf');
	}

	public static function edit($revision) {
		return panel()->urls()->index() . '/pages/' . $revision->id() . '/edit';
	}

	public static function revisions($page) {
		return panel()->urls()->index() . '/pages/' . $page->id() . '/revisions/edit';
	}

	public static function rollback($revision) {
		$lang = $revision->content()->language();
		$url = u() . '/revision.rollback/' . $revision->id() . '?csrf=' . s::get('csrf') . '&lang=' . $lang;
		return $url;
	}

	public static function delete($revision) {
		return u() . '/revision.delete/' . $revision->id() . '?csrf=' . s::get('csrf');
	}
}