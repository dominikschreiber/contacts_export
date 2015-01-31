<?php

$this->create('contacts-export_index', '/')->action(
    function($params) {
        require __DIR__ . '/../index.php';
    }
);

?>