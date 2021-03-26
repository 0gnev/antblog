<h1>Change password</h1>
<?php
$this->title = 'Change password';


/** @var $model \App\Models\ChangeModel */
use App\Views\form\Form;
?>
<?php $form = Form::begin('', 'post');?>
<?php echo $form->field($model, 'password')->passwordField(); ?>
<?php echo $form->field($model, 'passwordConfirm')->passwordField(); ?>

<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>
