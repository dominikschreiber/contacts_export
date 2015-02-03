<h1>Users</h1>
<?php foreach ($_['users'] as $user) { ?>
<h2><?php p($user['n']) ?></h2>
<table>
    <?php foreach ($user as $prop => $val) { ?>
    <tr>
        <th><?php p($prop) ?></th><td><?php p(implode(', ', $val)) ?></td>
    </tr>
    <?php } ?>
</table>
<?php } ?>