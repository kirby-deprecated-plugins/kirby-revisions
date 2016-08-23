<?php
include __DIR__ . DS . 'routes.php';

if( site()->user() ) {
	include __DIR__ . DS . 'filediff' . DS . 'filediff.php';
	include __DIR__ . DS . 'core' . DS . 'create-revision.php';
	include __DIR__ . DS . 'core' . DS . 'create-revisions.php';
	include __DIR__ . DS . 'core' . DS . 'query.php';
	include __DIR__ . DS . 'core' . DS . 'key.php';
	include __DIR__ . DS . 'core' . DS . 'collection.php';
	include __DIR__ . DS . 'core' . DS . 'blueprint.php';
	include __DIR__ . DS . 'core' . DS . 'url.php';
	include __DIR__ . DS . 'core' . DS . 'path.php';
	include __DIR__ . DS . 'core' . DS . 'misc.php';

	include __DIR__ . DS . 'core' . DS . 'revision.php';
	include __DIR__ . DS . 'core' . DS . 'rollback-revision.php';
	include __DIR__ . DS . 'register-hooks.php';
	include __DIR__ . DS . 'register-blueprints.php';
	include __DIR__ . DS . 'register-fields.php';
}