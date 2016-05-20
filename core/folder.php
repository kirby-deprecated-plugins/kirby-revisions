<?php
namespace JensTornell\Revisions;

use JensTornell\Revisions as Revisions;
use C;

class Folder {
	// Add revision folder
	public static function add( $page ) {
		$language_path = self::languagePath( $page->id() );

		if( ! file_exists( $language_path ) ) {
			@mkdir( $language_path, c::get('plugin.revisions.permission', 0755), true );
		}
	}

	// Delete folder with contents
	public static function delete($page) {
		$revisions_folder = Revisions\Folder::revisionPath( $page->id() );

		$iterator = new \RecursiveDirectoryIterator( $revisions_folder, \RecursiveDirectoryIterator::SKIP_DOTS );
		$paths = new \RecursiveIteratorIterator( $iterator, \RecursiveIteratorIterator::CHILD_FIRST );

		if( ! empty( $paths ) ) {
			foreach( $paths as $path ) {
				if( is_writable( $path->getRealPath() ) ) {
					if( $path->isDir() ) {
						@rmdir( $path->getRealPath() );
					} else {
						@unlink( $path->getRealPath() );
					}
				}
			}
		}
		if( is_writable( $revisions_folder ) ) {
			@rmdir( $revisions_folder );
		}
	}

	// Rename folder with contents
	public static function rename( $old, $new ) {
		$old_path = self::revisionPath( $old->id() );
		$new_path = self::revisionPath( $new->id() );

		if( file_exists( $old_path ) && is_writable( $old_path ) ) {
			@rename( $old_path, $new_path );
		}
	}

	// Revisions root path
	public static function rootPath() {
		return c::get('plugin.revisions.path', kirby()->roots()->index() . DS . 'revisions');
	}

	// Revision folder path
	public static function revisionPath( $uri ) {
		return self::rootPath() . DS . $uri;
	}

	// Language folder path
	public static function languagePath( $uri ) {
		$revision_path = self::revisionPath( $uri );
		$language_path = $revision_path . DS . self::language();
		return $language_path;
	}

	// Revisions + language folder
	public static function language() {
		if( site()->multilang() ) {
			$language = '.revisions' . DS . site()->language()->code();
		} else {
			$language = '.revisions';
		}
		return $language;
	}
}