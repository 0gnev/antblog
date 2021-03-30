<div class="container">
<?php


/** @var $this \Core\View */

use App\Views\form\Form;

$this->title = 'Login';
?>


<h1 class="py-3">Login</h1>

<?php $form = Form::begin('', 'post') ?>
    <?php echo $form->field($model, 'email') ?>
    <?php echo $form->field($model, 'password')->passwordField() ?>
    <button class="btn btn-success py-1 mb-3">Submit</button>
<?php Form::end() ?>
<a class="link-secondary pt-5" href="/reset">Reset password</a>
</div>