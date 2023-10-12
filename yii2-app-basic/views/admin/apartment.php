<?php

// /** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
?>
<div class="container">
  <?php $form1 = ActiveForm::begin([
    'id' => 'apart-form',
    'options' => [],
  ]); ?>


  <div class="d-flex flex-column bd-highlight">

    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>" />

    <div class="overflow-auto mt-3 mb-1" style="max-height:90vh;">
      <table class="bg-light table table-striped table-hover rounded align-middle" id="ApartmentTable">
        <thead>
          <tr>
            <th scope="col">id комнаты</th>
            <th scope="col">Тип комнаты</th>
            <th scope="col">Кол-во сп. мест</th>
            <th scope="col">Этаж</th>
            <th scope="col">Площадь (м2)</th>
            <th scope="col">Описание</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($apart as $item) : ?>
            <tr>
              <td><input type="hidden" name="" value=""><?php echo $item->id; ?></td>
              <td>
                <select class="form-select form-select-sm greenf border border-dark">
                  <?php foreach ($types as $item1) : ?>
                    <option value="<?php echo $item1->id; ?>" <?php if ($item1->id == $item->type) echo 'selected' ?>><?php echo $item1->name; ?></option>
                  <?php endforeach ?>
                </select>
              </td>
              <td><input type="number" class="form-control form-control-sm greenf" value="<?php echo $item->count; ?>" min="1" max="10000"></td>
              <td><input type="number" class="form-control form-control-sm greenf" min="1" max="10000" value="<?php echo $item->floor; ?>"></td>
              <td><input type="number" class="form-control form-control-sm greenf" value="<?php echo $item->area; ?>" min="1" max="10000"></td>
              <td><textarea rows="2"><?php echo $item->descrip; ?></textarea></td>
              <td> <a class='btn btn-sm col-auto ms-2 showReserv' title="Просмотреть брони"><img width="20px" src='../images/reserv.png'></a></td>
              <td> <a class='btn btn-sm col-auto ms-2' title="Сохранить изменения"><img width="20px" src='../images/check.png'></a></td>
              <td> <a class='btn btn-sm col-auto ms-2' title="Удалить запись"><img width="20px" src='../images/cancel.png'></a></td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>
    </div>
    <div class="w-75 bg-light rounded p-3 overflow-auto" style="max-height:30vh;">
      <label>Брони выбранного номера</label>
      <table class="bg-light table table-striped table-hover rounded align-middle" id="tableReserv">
        <thead>
          <tr>
            <th scope="col">id клиента</th>
            <th scope="col">Въезд</th>
            <th scope="col">Выезд</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
         
        </tbody>
      </table>
    </div>
    <div class="row p-2 mt-1 mx-1 bg-light rounded">
      <div class="col-auto">
        Тип комнаты
        <select class="form-select form-select-sm greenf mt-1" aria-label=".form-select-sm">
          <?php foreach ($types as $item) : ?>
            <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
          <?php endforeach ?>
        </select>
      </div>
      <div class="col-auto">
        Кол-во спальных мест
        <input type="number" style="width:80px;" class="form-control form-control-sm greenf" min="1" max="10000" placeholder="2" />
      </div>
      <div class="col-auto">
        Этаж
        <input type="number" style="width:80px;" class="form-control form-control-sm greenf" min="1" max="10000" placeholder="2" />
      </div>
      <div class="col-auto">
        Площадь
        <input type="number" style="width:80px;" class="form-control form-control-sm greenf " min="1" max="10000" placeholder="2" />
      </div>
      <div class="col-auto">
        <!-- При выборе имеющегося продукта будет произведено обновление данных* -->
        <div class="text-danger w-auto"></div>
        <a class="btn btn-outline-dark ms-2 btn-sm mt-4">Добавить</a>
      </div>
    </div>


    <div class="mt-1">
      <!-- <button class='float-end btn-sm btn btn-outline-light submit-food disabled'>Сохранить изменения</button> -->
    </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>