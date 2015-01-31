<style scoped>
li + li {
    margin-top: 2em;
}
</style>

<h1>Users</h1>
<ul>
<?php foreach ($_['users'] as $user) { ?>
<li><?php p($user) ?></li>
<?php } ?>
</ul>