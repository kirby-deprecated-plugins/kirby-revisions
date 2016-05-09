<?php
require_once __DIR__ . DS . 'core' . DS . 'language.php';
require_once __DIR__ . DS . 'core' . DS . 'folder.php';
require_once __DIR__ . DS . 'core' . DS . 'content.php';
require_once __DIR__ . DS . 'core' . DS . 'hooks.php';

// Register field
$kirby->set('field', 'revisions',  __DIR__ . DS . 'field');