<?php
$user_password = $user['password'] ?? '';
$user_email    = $user['email'] ?? '';
$user_name     = $user['name'] ?? '';
$user_message  = $user['message'] ?? '';
$user_avatar   = $user['avatar'] ?? '';
$classname     = isset($errors) ? " form--invalid" : "";?>
<form class="form container <?=$classname;?>" action"registratsiya.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Регистрация нового аккаунта</h2>

  <div class="form__item <?=isFormError($errors, 'email') ?'form__item--invalid' : '';?>"> <!-- form__item--invalid -->
    <label for="email">E-mail*</label>
    <input id="email" type="text" name="user[email]" placeholder="Введите e-mail" value="<?=$user_email;?>">
    <span class="form__error"><?= isFormError($errors, 'email') ? $errors['email'] : ''; ?></span>
  </div>

  <div class="form__item <?= isFormError($errors, 'password') ?'form__item--invalid' : ''; ?>">
    <label for="password">Пароль*</label>
    <input id="password" type="password" name="user[password]" placeholder="Введите пароль" value="<?=$user_password;?>">
    <span class="form__error"><?= isFormError($errors, 'password') ? $errors['password'] : ''; ?></span>
  </div>

  <div class="form__item <?= isFormError($errors, 'name') ?'form__item--invalid' : ''; ?>">
    <label for="name">Имя*</label>
    <input id="name" type="text" name="user[name]" placeholder="Введите имя" value="<?=$user_name;?>" >
    <span class="form__error"><?= isFormError($errors, 'name') ? $errors['name'] : ''; ?></span>
  </div>

  <div class="form__item <?= isFormError($errors, 'message') ?'form__item--invalid' : ''; ?>">
    <label for="message">Контактные данные*</label>
    <textarea id="message" name="user[message]" placeholder="Напишите как с вами связаться"><?=$user_message;?></textarea>
    <span class="form__error"><?= isFormError($errors, 'message') ? $errors['message'] : ''; ?></span>
  </div>

  <div class="form__item form__item--file form__item--last <?= isFormError($errors, 'avatar') ?'form__item--invalid' : ''; ?>">
    <label>Аватар</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="img/avatar.jpg" width="113" height="113" alt="Ваш аватар">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file"  name="avatar" id="photo2" value="<?=$user_avatar;?> ">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
    <span class="form__error"><?= isFormError($errors, 'avatar') ? $errors['avatar'] : ''; ?></span>
  </div>

  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Зарегистрироваться</button>
  <a class="text-link" href="#">Уже есть аккаунт</a>
</form>
