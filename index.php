<?php

\OCP\User::checkLoggedIn();
\OCP\App::checkAppEnabled('contacts-export');

$tpl = new OCP\Template('contacts-export', 'main', 'user');
$tpl->assign('msg', 'Hello World');
$tpl->printPage();

?>