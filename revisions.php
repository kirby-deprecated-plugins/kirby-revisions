<?php
include __DIR__ . DS . 'register-routes.php';

if( site()->user() ) {
	include __DIR__ . DS . 'core' . DS . 'create-revision.php';
	include __DIR__ . DS . 'core' . DS . 'create-revisions.php';
	include __DIR__ . DS . 'core' . DS . 'collection.php';
	include __DIR__ . DS . 'core' . DS . 'blueprint.php';
	include __DIR__ . DS . 'core' . DS . 'restore-revision.php';
	include __DIR__ . DS . 'core' . DS . 'rollback-revision.php';
	include __DIR__ . DS . 'register-hooks.php';
	include __DIR__ . DS . 'register-blueprints.php';
	include __DIR__ . DS . 'register-fields.php';
}