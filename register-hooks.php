<?php
use JensTornell\Revisions as Revisions;

kirby()->hook('panel.page.create', function( $page ) {
	$obj = new Revisions\CreateRevisions( $page );
	$obj = new Revisions\CreateRevision();
	$obj->go( $page, 'create', $page->content()->language() );
});

kirby()->hook('panel.page.update', function( $page ) {
	$obj = new Revisions\CreateRevisions( $page );
	$obj = new Revisions\CreateRevision();
	$obj->go( $page, 'update', $page->content()->language() );
});

function debug_hook($content) {
	$dir = kirby()->roots()->index() . DS . 'hook.page.txt';
	file_put_contents($dir, $content);
}