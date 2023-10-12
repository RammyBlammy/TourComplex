<?php

// /** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;
?>
<div class="container">
  <?php $form1 = ActiveForm::begin([
    'id' => 'food-form',
    'options' => [],
  ]); ?>
  <div class="row mb-2 w-50">
    <!-- <div class="col d-flex align-items-center justify-content-center">Mеню:</div> -->
    <div class="col w-75">
      <select class="form-select form-select-sm greenf" id="menusel" aria-label=".form-select-sm">
        <option>Стандарт</option>
        <option>Стандарт+</option>
        <option>Детское</option>
      </select>
    </div>
    <a class='btn btn-sm col btn-outline-light ms-1 me-2 col w-25' id="loadMenu">загрузить меню</a>

  </div>


  <div class="d-flex flex-column bd-highlight">

    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>" />
    <div class="overflow-auto mt-3 mb-1" style="max-height:90vh;">
      <table class="bg-light table table-striped table-hover rounded align-middle" id="foodtable">
        <thead>
          <tr>
            <th scope="col" class="w-50">Продукт</th>
            <th scope="col">1 единица</th>
            <th scope="col">Ед. изм.</th>
            <th scope="col">Кол-во (шт.)</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($menu as $item) : ?>
            <tr>
              <!-- <td>
                <div>
                  <input class="form-check-input bg-dark variant" type="checkbox" aria-label="...">
                </div>
              </td> -->
              <td><input type="hidden" name="" value=""><?php echo $item->food->product; ?></td>
              <td ><input type="number" name="quant" class="form-control form-control-sm greenf" min="1" max="10000" value="<?php echo $item['1ed']; ?>"></td>
              <td contenteditable="true"><input type="hidden"  value=""><?php echo $item->unit; ?></td>
              <td ><input type="number" name="quant2" class="form-control form-control-sm greenf" value="<?php echo $item->count; ?>" min="1" max="10000" style="width:100px;" /></td>
              <td> <a class='btn btn-sm col-auto ms-2 add' title="Сохранить изменения"><img width="20px" src='../images/check.png'></a></td>
              <td> <a class='btn btn-sm col-auto ms-2 cancel' title="Удалить запись"><img width="20px" src='../images/cancel.png'></a></td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>
    </div>

    <div class="row p-2 mt-1 mx-1 bg-light rounded">
      <div class="col-auto">
        Продукт
        <select class="form-select form-select-sm greenf mt-1" id="selAdd" aria-label=".form-select-sm">
          <?php foreach ($food as $item) :?>
            <option value="<?php echo $item->id;?>"><?php echo $item->product;?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="col-auto">
        1 единица
        <input type="number"  style="width:80px;" id="inputEdAdd" class="form-control form-control-sm greenf mt-1" min="1" max="10000" placeholder="50" />
      </div>
      <div class="col-auto">
        Единица измерения
        <input type="text" class="form-control form-control-sm greenf mt-1" id="inputIzAdd" placeholder="г/мл/...">
      </div>
      <div class="col-auto">
        Кол-во (шт.)
        <input type="number" style="width:80px;" class="form-control form-control-sm greenf mt-1" id="inputCountAdd" min="1" max="10000" placeholder="2" />
      </div>
      <div class="col-auto">
        <div class="text-danger w-auto">При выборе имеющегося продукта будет произведено обновление данных*</div>
        <a class="btn btn-outline-dark ms-2 btn-sm submit-add mt-1">Добавить</a>
      </div>
    </div>


    <div class="mt-1">
      <!-- <button class='float-end btn-sm btn btn-outline-light submit-food disabled'>Сохранить изменения</button> -->
    </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>