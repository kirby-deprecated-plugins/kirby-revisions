<?php
class PluginRevisionsLanguage {
	// Get language file path
	public static function path() {
		$language = site()->user()->language();
		$root = __DIR__ . DS . '..' . DS . 'languages';

		$custom = $root . DS . $language . '.php';
		$default = $root . DS . 'en.php';

		if( file_exists( $custom ) ) {
			return $custom;
		} else {
			return $default;
		}
	}

	// Check if the current language is the default one
	public static function isDefault() {
		if( ! site()->multilang() ) return true;
		if( site()->language()->default() ) return true;
	}
}