<?php

$this->create('contacts_export_index', '/')->action(
    function($params) {
        require __DIR__ . '/../index.php';
    }
);

?>