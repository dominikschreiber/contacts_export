<?php

\OCP\User::checkLoggedIn();
\OCP\App::checkAppEnabled('contacts_export');

$tpl = new OCP\Template('contacts_export', 'main', 'user');
$tpl->assign('msg', 'Hello World');
$tpl->printPage();

?>