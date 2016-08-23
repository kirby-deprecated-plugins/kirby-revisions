<?php
namespace JensTornell\Revisions;
use JensTornell\Revisions as Revisions;

class Misc {
	function stringInString($needle, $haystack) {
		$pos = strpos($haystack, $needle);
		if($pos === false) {
			return false;
		}
		else {
			return true;
		}
	}
}