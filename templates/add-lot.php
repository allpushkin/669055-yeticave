<?php 
$lot_tit        = $lot['title'] ?? '';
$lot_desc       = $lot['description'] ?? '';
$lot_img        = $lot['img_path'] ?? '';
$lot_price      = $lot['starting_price'] ?? '';
$lot_step       = $lot['bed_step'] ?? '';
$lot_date       = $lot['date_end'] ?? '';
$lot_category   = $lot['category'] ?? '';
$classname      = isset($errors) ? " form--invalid" : "";
?>
<form class="form form--add-lot container <?=$classname;?>" action="add.php" method="post" enctype="multipart/form-data"> <!-- form--invalid -->
  <h2>Добавление лота</h2>
  <div class="form__container-two">

    <div class="form__item <?= isFormError($errors, 'title') ?'form__item--invalid' : ''; ?>"> <!-- form__item--invalid -->
      <label for="lot-name">Наименование</label>
      <input id="lot-name" type="text" name="lot[title]" placeholder="Введите наименование лота" value="<?=$lot_tit;?>">
      <span class="form__error"><?= isFormError($errors, 'title') ? $errors['title'] : ''; ?></span>
    </div>

    <div class="form__item <?= isFormError($errors, 'category') ?'form__item--invalid' : ''; ?>">
      <label for="category">Категория</label>
      <select id="category" name="lot[category]" required>
        <option>Выберите категорию</option>
          <?php foreach ($categories as $category): ?>
            <option value="<?=$category['id'];?>" 
              <?php if($category['id'] == $lot_category): echo ' selected'; endif;?>><?= $category['name']; ?>
            </option>
          <?php endforeach; ?>
      </select>
      <span class="form__error"><?= isFormError($errors, 'category') ? $errors['category'] : ''; ?></span>
    </div>

  </div>

  <div class="form__item form__item--wide <?= isFormError($errors, 'description') ?'form__item--invalid' : ''; ?>">
    <label for="message">Описание</label>
    <textarea id="message" name="lot[description]" placeholder="Напишите описание лота"><?=$lot_desc;?></textarea>
    <span class="form__error"><?= isFormError($errors, 'description') ? $errors['description'] : ''; ?></span>
  </div>

  <div class="form__item form__item--file <?= isFormError($errors, 'img_path') ?'form__item--invalid' : ''; ?>"> <!-- form__item--uploaded -->
    <label>Изображение</label>
    <div class="preview">
      <button class="preview__remove" type="button">x</button>
      <div class="preview__img">
        <img src="img/avatar.jpg" width="113" height="113" alt="Изображение лота">
      </div>
    </div>
    <div class="form__input-file ">
      <input class="visually-hidden" type="file" name="img_path" id="photo2" value="">
      <label for="photo2">
        <span>+ Добавить</span>
      </label>
    </div>
    <span class="form__error"><?= isFormError($errors, 'img_path') ? $errors['img_path'] : ''; ?></span>
  </div>

  <div class="form__container-three">

    <div class="form__item form__item--small <?= isFormError($errors, 'starting_price') ?'form__item--invalid' : ''; ?>">
      <label for="lot-rate">Начальная цена</label>
      <input id="lot-rate" type="number" name="lot[starting_price]"  placeholder="0"  value="<?=$lot_price;?>">
      <span class="form__error"><?= isFormError($errors, 'starting_price') ? $errors['starting_price'] : ''; ?></span>
    </div>

    <div class="form__item form__item--small <?= isFormError($errors, 'bed_step') ?'form__item--invalid' : ''; ?>">
      <label for="lot-step">Шаг ставки</label>
      <input id="lot-step" type="number" name="lot[bed_step]" placeholder="0" value="<?=$lot_step;?>">
      <span class="form__error"><?= isFormError($errors, 'bed_step') ? $errors['bed_step'] : ''; ?></span>
    </div>

    <div class="form__item <?= isFormError($errors, 'date_end') ?'form__item--invalid' : ''; ?>">
      <label for="lot-date">Дата окончания торгов</label>
      <input class="form__input-date" id="lot-date" type="date" name="lot[date_end]" value="<?=$lot_date;?>">
      <span class="form__error"><?= isFormError($errors, 'date_end') ? $errors['date_end'] : ''; ?></span>
    </div>

  </div>
    <span class="form__error form__error--bottom">Пожалуйста, исправьте ошибки в форме.</span>
  <button type="submit" class="button">Добавить лот</button>
</form>
