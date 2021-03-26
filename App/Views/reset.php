<?php

use App\Views\form\Form;
?>
<h1>Reset</h1>
<?php $form = Form::begin('', 'post');?>
<?php echo $form->field($model, 'email'); ?>

<button type="submit" class="btn btn-primary">Submit</button>
<?php Form::end(); ?>