<?php


/** @var $this \Core\View */

use App\Views\form\Form;

$this->title = 'Login';
?>


<h1>Login</h1>

<?php $form = Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <button class="btn btn-success">Submit</button>
<?php Form::end() ?>
<a class="nav-link" href="/reset">Reset password</a>
