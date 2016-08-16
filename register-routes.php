<?php
use JensTornell\Revisions as Revisions;

// Revision rollback
if( site()->user() ) {
	kirby()->routes(array(
		array(
			'pattern' => 'revision.rollback/(.+)',
			'action'  => function($uid) {
				$page = page($uid)->parent()->parent();

				$revision = new Revisions\CreateRevision();
				$rollback = new Revisions\Rollback();

				$rollback->go($uid);
				$revision->go($page, 'rollback', get('lang'));

				$backurl = u() . '/panel/pages/' . $page->id() . '/edit';
				go($backurl);
			}
		),
	));
}

// Redirect the revisions to error
kirby()->routes(array(
	array(
		'pattern' => ['(.+)/revisions', '(.+)/revisions/(.+)'],
		'action'  => function($uri) {
			echo $uri;
			header::status('404');
			go('error');
		}
	),
));