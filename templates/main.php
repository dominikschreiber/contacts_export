<h1>Users</h1>
<?php foreach ($_['users'] as $user): ?>
<h2><?php p($user['n']); ?></h2>
<dl>
<?php foreach ($user as $prop => $val): ?>
    <dt><?php p($prop); ?></dt>
    <dd><?php p($val); ?></dd>
<?php endforeach; ?>
</dl>
<?php endforeach; ?>