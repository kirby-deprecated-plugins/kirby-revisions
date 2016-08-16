<?php
namespace JensTornell\Revisions;
use JensTornell\Revisions as Revisions;

class Restore {
	function __construct($page) {
		new Revisions\CreateRevisions( $page );
		new Revisions\CreateRevision( $page, 'rollback', get('lang') );
	}
}