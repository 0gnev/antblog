<?php
/** @var $this \Core\View */

use App\Views\form\Form;
use App\Views\form\TextareaField;


/** @var $model \App\Models\ContactForm */
$this->title = 'Contact';
?>
<h1>Contact us</h1>

<?php $form = Form::begin('', 'post');?>
<?php echo $form->field($model, 'subject'); ?>
<?php echo $form->field($model, 'email'); ?>
<?php echo new TextareaField($model, 'body') ?>
<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>
