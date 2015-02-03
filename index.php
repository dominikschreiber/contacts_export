<?php
function init() {
    \OCP\User::checkLoggedIn();
    \OCP\App::checkAppEnabled('contacts_export');
}

function raw() {
    $sql = 'SELECT carddata FROM `*PREFIX*contacts_cards` WHERE addressbookid = 5';
    $args = array();
    $query = \OCP\DB::prepare($sql);
    $result = $query->execute($args);

    $users = array();
    while ($row = $result->fetchRow()):
        $users[] = $row['carddata'];
    endwhile;
    
    return $users;
}

function parse($raw) {
    $parsed = array();
    
    foreach ($raw as $rawUser):
        foreach (explode('\n', str_replace('\n ', '', $rawUser)) as $line):
            $keyValues = explode(':', $line);
            $parsed[strtolower($keyValues[0])] = array_filter(explode(';', $keyValues[1]), function($v) { return $v != ''; });
        endforeach;
    endforeach;
    
    return $parsed;
}

function formatUser($vcard) {
    unset($vcard['begin']);
    unset($vcard['photo']);
    unset($vcard['rev']);
    unset($vcard['end']);
    
    return $vcard;
}

function format($parsed) {
    return array_map('formatUser', $parsed);
}

function render($formatted) {
    $tpl = new OCP\Template('contacts_export', 'main', 'user');
    $tpl->assign('users', $formatted);
    $tpl->printPage();
}

function main() {
    init();
    render(format(parse(raw())));
}

main();
?>