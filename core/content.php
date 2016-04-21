<?php
class PluginRevisionsContent {
	// Add page and clean up
	public static function add($page) {
		$filename = date('Y-m-d@H.i.s') . '-' . $page->intendedTemplate() . '.txt';
		$language_path = PluginRevisionsFolder::languagePath( $page->id() );

		if( file_exists( $language_path ) && is_writable( $language_path ) ) {
			$revision_path = $language_path . DS . $filename;
			$has_copied = self::copy( $page->content()->root(), $revision_path );
			if( $has_copied ) {
				self::cleanup($page);
			}
		}
	}

	// Clean up revisions to limit
	public static function cleanup($page) {
		$path = PluginRevisionsFolder::languagePath( $page->id() );
		$pages = array_reverse( glob( $path . DS . '*' ) );
		if( self::limit() !== false ) {
			$pages = array_slice( $pages, self::limit() );
			if( ! empty( $pages ) ) {
				foreach( $pages as $item ) {
					if( file_exists( $item ) && is_writable( $item ) ) {
						@unlink( $item );
					}
				}
			}
		}
	}

	// Get revision limit number per page
	public static function limit() {
		return c::get('plugin.revisions.limit', false);
	}

	// Get url by page and filename. Used in field template
	public static function url( $page, $filename ) {
		$language = '';
		if( site()->multilang() ) {
			$language = site()->language()->code() . '/';
		}
		$root = kirby()->urls()->index() . '/' . basename( PluginRevisionsFolder::rootPath() );
		$url = $root . '/' . $page->id() . '/.revisions/' . $language . $filename;
		return $url;
	}

	// Convert filename to date
	public static function date( $filename ) {
		return substr($filename, 0, 10);
	}

	// Convert filename to time
	public static function time( $filename ) {
		return substr($filename, 11, 8);
	}

	// Convert filename to template
	public static function template( $filename ) {
		return substr($filename, 20);
	}

	// Copy file from content folder to revision folder
	public static function copy( $filepath, $revision_path ) {
		return @copy( $filepath, $revision_path );
	}
}
?>