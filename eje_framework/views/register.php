<h1>Register !!!</h1>

<?php $form = \app\core\widgets\Form::begin('', 'POST') ?>
<?php $form->field($model, 'firstName') ?>
<?php $form->field($model, 'lastName') ?>
<?php $form->field($model, 'email') ?>
<?php $form->field($model, 'password') ?>
<?php $form->field($model, 'confirmPassword') ?>
<button type="submit" class="btn btn-primary">Save</button>
<?= \app\core\widgets\Form::end() ?>
