<h1>Register !!!</h1>

<?php $form = \app\core\widgets\Form::begin('', 'POST') ?>
<div class="row">
<div class="col">
<?php $form->field($model, 'firstName') ?>
</div>
<div class="col">
<?php $form->field($model, 'lastName') ?>
</div>
</div>
<?php $form->field($model, 'email')->mailField() ?>
<?php $form->field($model, 'password')->passwordField() ?>
<?php $form->field($model, 'confirmPassword') ?>
<button type="submit" class="btn btn-primary">Save</button>
<?= \app\core\widgets\Form::end() ?>

