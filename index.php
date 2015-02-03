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
    while ($row = $result->fetchRow()) {
        $users[] = $row['carddata'];
    }
    
    return $users;
}

function parse($raw) {
    $parsed = array();
    foreach ($raw as $rawUser) {
        foreach (explode('\n', str_replace('\n ', '', $rawUser)) as $line) {
            $keyValues = explode(':', $line);
            $parsed[strtolower($keyValues[0])] = explode(';', $keyValues[1]);
        }
    }
    return $parsed;
}

function formatUser($parsed) {
    unset($parsed['photo']);
    return $parsed;
}

function format($parsed) {
    if (count($parsed) == 1) {
        return array(formatUser($parsed));
    } else {
        $formatted = array();
        foreach ($parsed as $vcard) {
            $formatted[] = formatUser($vcard);
        }
        return $formatted;
    }
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