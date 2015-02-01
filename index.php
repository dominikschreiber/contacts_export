<?php
include 'lib/vCards.php';

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
    $vcard = new vCard(false, $raw);
    if (count($vcard) == 1) {
        return [
              ["name" => $vcard->n]
        ];
    } else {
        $parsed = [];
        foreach ($vcard as $c) {
            $parsed[] = ["name" => $c->n]
        }
        return $parsed;
    }
}

function format($parsed) {
    return $parsed;
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