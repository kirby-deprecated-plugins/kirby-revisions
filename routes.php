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

				$panel_root_url = c::get('plugin.revisions.panel.root.url', u() . '/panel');
				$back_url = $panel_root_url . '/pages/' . $page->id() . '/edit';
				go($back_url);
			}
		),
		array(
			'pattern' => 'revision.delete/(.+)',
			'action'  => function($uid) {
				if(s::get('csrf') == get('csrf') ) {
					$revision = page($uid);
					$page = page($uid)->parent()->parent();
					$revision->delete(true);

					$panel_root_url = c::get('plugin.revisions.panel.root.url', u() . '/panel');
					$back_url = $panel_root_url . '/pages/' . $page->id() . '/edit';

					go($back_url);
				}
				go(site()->errorPage());
			}
		),
		array(
			'pattern' => 'revisions.delete.all/(.+)',
			'action'  => function($uid) {
				if(s::get('csrf') == get('csrf') ) {
					$page = page($uid);
					$revisions = $page->find('revisions');
					$revisions->delete(true);

					$panel_root_url = c::get('plugin.revisions.panel.root.url', u() . '/panel');
					$back_url = $panel_root_url . '/pages/' . $page->id() . '/edit';

					go($back_url);
				}
				go(site()->errorPage());
			}
		),
	));
}

// Redirect the revisions to error
kirby()->routes(array(
	array(
		'pattern' => ['(.+)/revisions', '(.+)/revisions/(.+)'],
		'action'  => function($uri) {
			header::status('404');
			go(site()->errorPage());
		}
	),
));