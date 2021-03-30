<div class="container">
<h1>Change email</h1>
<?php
$this->title = 'Change email';


/** @var $model \App\Models\ChangeModel */
use App\Views\form\Form;
?>
<?php $form = Form::begin('', 'post');?>
<?php echo $form->field($model, 'email'); ?>
<?php echo $form->field($model, 'emailConfirm'); ?>

<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>
</div>