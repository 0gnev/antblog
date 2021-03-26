<?php
/** @var $this \Core\View */

use Core\Application;

$this->title = 'Profile';
?>
<h1>Profile</h1>
<h2>Welcome <?php echo Application::$app->user->getDisplayName() ?></h2>
<div class="row">
        <div class="col">
            <a class="nav-link" href="/change_password">Change password</a>
        </div>
        <div class="col">
            <a class="nav-link" href="/change_email">Change email</a>
        </div>
</div>