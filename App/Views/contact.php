<?php
/** @var $this \Core\View */

use Core\form\Form;

/** @var $model \App\Models\ContactForm */
$this->title = 'Contact';
?>
<h1>Contact us</h1>

<?php $form = Form::begin('', 'post');?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>
