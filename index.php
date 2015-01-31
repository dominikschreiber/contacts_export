<?php

\OCP\User::checkLoggedIn();
\OCP\App::checkAppEnabled('contacts_export');

$sql = 'SELECT carddata FROM `*PREFIX*contacts_cards` WHERE addressbookid = 5';
$args = array();
$query = \OCP\DB::prepare($sql);
$result = $query->execute($args);

$users = array();
while ($row = $result->fetchRow()) {
    $users[] = $row['carddata'];
}

$tpl = new OCP\Template('contacts_export', 'main', 'user');
$tpl->assign('users', $users);
$tpl->printPage();

?>