<?php
namespace JensTornell\Revisions;

class Path {
	public static function root() {
		return kirby()->roots()->plugins() . DS . 'kirby-revisions';
	}

	public static function headings() {
		return self::root() . DS . 'snippets' . DS . 'revisions-headings.php';
	}

	public static function footer() {
		return self::root() . DS . 'snippets' . DS . 'revisions-footer.php';
	}

	public static function rows() {
		return self::root() . DS . 'snippets' . DS . 'revisions-rows.php';
	}

	public static function blueprintDefault() {
		return kirby()->roots()->blueprints() . DS . 'default';
	}

	public static function blueprintPath($template) {
		return kirby()->roots()->blueprints() . DS . $template;
	}
}