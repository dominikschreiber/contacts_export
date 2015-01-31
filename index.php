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

function vcardproperty_to_associativearray($property) {
    $c = explode('=', $property);
    return array($c[0] => $c[1]);
}
function merge_associativearrays($prev, $now) {
    return $prev + $now;
}
function format_vcard($vcard) {
    $properties = array_reduce('merge_associativearrays', array_map('vcardproperty_to_associativearray', explode(';', $vcard)), array());
    return $properties['N'];
}
$formatted_users = array_map('format_vcard', $users);

$tpl = new OCP\Template('contacts_export', 'main', 'user');
$tpl->assign('users', $users);
$tpl->printPage();

?>