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

function format($raw) {
    return $raw;
}

function render($formatted) {
    $tpl = new OCP\Template('contacts_export', 'main', 'user');
    $tpl->assign('users', $formatted);
    $tpl->printPage();
}

function main() {
    init();
    render(format(raw()));
}

main();
?>