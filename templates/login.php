<?php
$login_email    = $login['email'] ?? '';
$login_password = $login['password'] ?? '';
$classname = empty($errors) ? 'form--invalid' : '';?>
<form class="form container <?=$classname?>" action="login.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Вход</h2>
  <div class="form__item <?=isFormError($errors, 'email') ?'form__item--invalid' : '';?>"> <!-- form__item--invalid -->
    <label for="email">E-mail*</label>
    <input id="email" type="text" name="login[email]" placeholder="Введите e-mail" value="<?=$login_email;?>">
    <span class="form__error"><?= isFormError($errors, 'email') ? $errors['email'] : ''; ?></span>
  </div>
  <div class="form__item form__item--last <?= isFormError($errors, 'password') ?'form__item--invalid' : ''; ?>">
    <label for="password">Пароль*</label>
    <input id="password" type="password" name="login[password]" placeholder="Введите пароль" value="<?=$login_password;?>">
    <span class="form__error"><?= isFormError($errors, 'password') ? $errors['password'] : ''; ?></span>
  </div>
  <button type="submit" class="button">Войти</button>
</form>
