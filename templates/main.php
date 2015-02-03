<h1>Users</h1>
<?php foreach ($_["users"] as $user): ?>
<pre><?php
ob_start();
var_dump($user);
print_unescaped(ob_get_clean());
?></pre>
<?php endforeach; ?>