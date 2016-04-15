<?php
require_once __DIR__ . DS . 'core' . DS . 'language.php';
require_once __DIR__ . DS . 'core' . DS . 'folder.php';
require_once __DIR__ . DS . 'core' . DS . 'content.php';

// Register field
$kirby->set('field', 'revisions',  __DIR__ . DS . 'field');

// Revision callback
$save_revision = function( $page ) {
	RevisionsFolder::add( $page );
	RevisionContent::add( $page );
};

// Add revision on create and update
kirby()->hook('panel.page.create', $save_revision );
kirby()->hook('panel.page.update', $save_revision );

// Delete revision on delete
kirby()->hook('panel.page.delete', function( $page ) {
	RevisionsFolder::delete( $page );
});

// If page is renamed and is default language, rename revision, else add new revision.
kirby()->hook('panel.page.move', function( $new, $old ) {
	if( RevisionsLanguage::isDefault() === true ) {
		RevisionsFolder::rename( $old, $new );
	} else {
		RevisionsFolder::add( $new );
		RevisionContent::add( $new );
	}
});

// Temp
function debug_hook($content) {
	$dir = kirby()->roots()->index() . DS . 'hook.page.txt';
	file_put_contents($dir, $content);
}