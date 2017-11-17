<h1>INDEX</h1>
<?php if (!empty($users)): ?>
	<?php foreach ($users as $user): ?>
        <p><?= $user['territory'] ?></p>
	<?php endforeach; ?>
<?php endif; ?>
