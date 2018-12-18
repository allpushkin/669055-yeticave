<section class="lot-item container">
  <h2><?= esc($lot["title"]); ?></h2>
  <div class="lot-item__content">
    <div class="lot-item__left">
      <div class="lot-item__image">
        <img src="<?= $lot["img_path"] ?>" width="730" height="548" alt="Сноуборд">
      </div>
      <p class="lot-item__category">Категория: <span><?= esc($lot["category_name"])?></span></p>
      <p class="lot-item__description"><?= esc($lot["description"]); ?></p>
    </div>
    <?php if (isset($_SESSION['user'])):?>
    <div class="lot-item__right">
      <div class="lot-item__state">
        <?php if (!$expiration_dt): ?>
        <div class="lot-item__timer timer">
          <?= lotTimeLeft($lot['expiration_dt']); ?>
        </div>
        <?php endif; ?>
        <div class="lot-item__cost-state">
          <div class="lot-item__rate">
            <span class="lot-item__amount">Текущая цена</span>
            <span class="lot-item__cost">
              <?php
              if($lot['price']) {
                  print(format_sum(esc($lot['price'])));
              } else {
                  print(format_sum(esc($lot['starting_price'])));
              }
              ?>
            </span>
          </div>
          <div class="lot-item__min-cost">
            Мин. ставка <span><?= format_sum($min_bet) ?></span>
          </div>
        </div>
        <form class="lot-item__form" action="../lot.php?id=<?=$lot['id']?>" method="post">
          <?php $classname = !empty($error) ? 'form__item--invalid' : '';
          $value = isset($bet) ? $bet : ""; ?>
          <p class="lot-item__form-item form__item <?=$classname;?>">
            <label for="cost">Ваша ставка</label>
            <input id="cost" type="text" name="price" placeholder= "<?=$min_bet;?>">
            <span class="form__error"><?=$error;?></span>
          </p>
          <button type="submit" class="button">Сделать ставку</button>
        </form>
      </div>
      <?php endif;?>
      <div class="history">
        <h3>История ставок (<?=count($lot_bid);?>)</h3>
        <table class="history__list">
          <?php if (count($lot_bid)):?>
            <?php foreach ($lot_bid as $key):?>
              <tr class="history__item">
                  <td class="history__name"><?=$key['name']?></td>
                  <td class="history__price"><?=format_sum($key['price'])?></td>
                  <td class="history__time"><?=time_of_bet($key['dt_add']);?></td>
              </tr>
           <?php endforeach;?>
         <?php endif;?>
        </table>
      </div>
    </div>
  </div>
</section>
