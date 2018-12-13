<?php $classname = isset($errors) ? " form--invalid" : ""; ?>
<form class="form form--add-lot container <?=$classname;?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Добавление лота</h2>
  <div class="form__container-two">
    <?php $classname = isset($errors['title']) ? 'form__item--invalid' : '';
          $error     = isset($errors['title']) ? $errors['title'] : "";
          $value     = isset($lot['title']) ? $lot['title'] : ""; ?>
    <div class="form__item <?=$classname;?>"> <!-- form__item--invalid -->
      <label for="lot-name">Наименование</label>
      <input id="lot-name" type="text" name="lot[title]" placeholder="Введите наименование лота" value="<?=$value;?>">
      <span class="form__error"><?=$error;?></span>
    </div>
   <?php $classname = isset($errors['category']) ? 'form__item--invalid' : '';
         $error     = isset($errors['category']) ? $errors['category'] : "";
         $value      = isset($lot['category']) ? $lot['category'] : ""; ?>
    <div class="form__item <?=$classname;?>">
      <label for="category">Категория</label>
      <select id="category" name="lot[category]" required>
        <option>Выберите категорию</option>
        <?php foreach ($categories as $category): ?>
          <option value="<?=$category['id'];?>"><?= $category['name']; ?></option>
        <?php endforeach; ?>
      </select>
      <span class="form__error">Выберите категорию</span>
    </div>
    <?php $classname = isset($errors['desc']) ? 'form__item--invalid' : '';
          $error     = isset($errors['desc']) ? $errors['desc'] : "";
          $value     = isset($lot['desc']) ? $lot['desc'] : ""; ?>
  </div>
  <div class="form__item form__item--wide <?=$classname;?>">
    <label for="message">Описание</label>
    <textarea id="message" name="lot[desc]" placeholder="Напишите описание лота" value="<?=$value;?>"></textarea>
    <span class="form__error"><?=$error;?></span>
  </div>
   <?php $classname = isset($lot['img_path']) ? 'form__item--uploaded' : ''; ?>
  <div class="form__item form__item--file <?=$classname;?>"> <!-- form__item--uploaded -->
    <label>Изображение</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
      </div>
    </div>
    <div class="form__input-file">
      <input class="visually-hidden" type="file" id="photo2" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
  </div>
  <div class="form__container-three">
    <?php $classname = isset($errors['starting_price']) ? 'form__item--invalid' : '';
          $error     = isset($errors['starting_price']) ? $errors['starting_price'] : "";
          $value     = isset($lot['starting_price']) ? $lot['starting_price'] : ""; ?>
    <div class="form__item form__item--small">
      <label for="lot-rate">Начальная цена</label>
      <input id="lot-rate" type="number" name="lot[starting_price]"  placeholder="0"  value="<?=$value;?>">
      <span class="form__error"><?=$error;?></span>
    </div>
    <?php $classname = isset($errors['bed_step']) ? 'form__item--invalid' : '';
          $error     = isset($errors['bed_step']) ? $errors['bed_step'] : "";
          $value     = isset($lot['bed_step']) ? $lot['bed_step'] : ""; ?>
        <div class="form__item form__item--small <?=$classname;?>">
      <label for="lot-step">Шаг ставки</label>
      <input id="lot-step" type="number" name="lot[bed_step]" placeholder="0" value="<?=$value;?>">
      <span class="form__error"><?=$error;?></span>
    </div>
     <?php $classname = isset($errors['date_end']) ? 'form__item--invalid' : '';
           $error = isset($errors['date_end']) ? $errors['date_end'] : "";
           $value = isset($lot['date_end']) ? $lot['date_end'] : ""; ?>
    <div class="form__item <?=$classname;?>">
      <label for="lot-date">Дата окончания торгов</label>
      <input class="form__input-date" id="lot-date" type="date" name="lot['date_end']" value="<?=$value;?>">
      <span class="form__error"><?=$error;?></span>
    </div>
  </div>

  <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Добавить лот</button>
</form>
