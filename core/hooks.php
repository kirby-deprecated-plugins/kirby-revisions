<?php
use JensTornell\Revisions as Revisions;

// Revision callback
$save_revision = function( $page ) {
	Revisions\Folder::add( $page );
	Revisions\Content::add( $page );
};

// Add revision on create and update
kirby()->hook('panel.page.create', $save_revision );
kirby()->hook('panel.page.update', $save_revision );

// Delete revision on delete
if( c::get('plugin.revisions.delete', true ) ) {
	kirby()->hook('panel.page.delete', function( $page ) {
		Revisions\Folder::delete( $page );
	});
}

// If page is renamed and is default language, rename revision, else add new revision.
kirby()->hook('panel.page.move', function( $new, $old ) {
	if( JensTornell\revisions\Language::isDefault() ) {
		Revisions\Folder::rename( $old, $new );
	} else {
		Revisions\Folder::add( $new );
		Revisions\Content::add( $new );
	}
});

// Temp
function debug_hook($content) {
	$dir = kirby()->roots()->index() . DS . 'hook.page.txt';
	file_put_contents($dir, $content);
}