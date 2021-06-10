<h1>Register !!!</h1>

<form method="POST">
  <div class="mb-3">
    <label class="form-label">FirstName</label>
    <input type="text" name="firstName" value="<?= $model->firstName ?>" 
    class="form-control <?= $model->hasError('firstName') ? 'is-invalid' : '' ?>">
    <div class="invlaid-feedback">
      <?= $model->getFirstError('firstName') ?>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">LastName</label>
    <input type="text" name="lastName" value="<?= $model->lastName ?>" 
    class="form-control <?= $model->hasError('lastName') ? 'is-invalid' : '' ?>">
    <div class="invlaid-feedback">
      <?= $model->getFirstError('lastName') ?>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Email</label>
    <input type="text" name="email" value="<?= $model->email ?>" 
    class="form-control <?= $model->hasError('email') ? 'is-invalid' : '' ?>">
    <div class="invlaid-feedback">
      <?= $model->getFirstError('email') ?>
    </div>
  </div>
  <div class="mb-3">
    <label class="form-label">Password</label>
    <input type="password" name="password" class="form-control">
  </div>
  <div class="mb-3">
    <label class="form-label">Confirm Password</label>
    <input type="password" name="confirmPassword" class="form-control">
  </div>

  <button type="submit" class="btn btn-primary">Save</button>
</form>