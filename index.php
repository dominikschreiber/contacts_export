<?php
require 'includes/vCards.php';

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
    return new vCard(false, $raw, array('Collapse' => true));
}

function format($parsed) {
    if (count($parsed) == 1) {
        return array(
              array('name' => $parsed->n)
        );
    } else {
        $formatted = array();
        foreach ($parsed as $vcard) {
            $formatted[] = array('name' => $vcard->n);
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