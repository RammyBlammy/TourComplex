<?php

// /** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;
?>
<div class="container">
  <?php $form1 = ActiveForm::begin([
    'id' => 'eq-form',
    'options' => [],
  ]); ?>
  
  <div class="d-flex flex-column bd-highlight">

    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>" />
    <div class="overflow-auto mt-3 mb-1" style="max-height:70vh;">
      <table class="bg-light table table-striped table-hover rounded align-middle" id="equipment">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col" class="w-50">Снаряжение</th>
            <th scope="col">Кол-во (шт.)</th>
            <th scope="col">Используется</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($equipm as $item) : ?>
            <tr>
              <td><input type="hidden" name="" value=""><?php echo $item->id; ?></td>
              <td contenteditable="true"><input type="hidden" name="" value=""><?php echo $item->name; ?></td>
              <td ><input type="number" style="width:100px;" class="form-control form-control-sm greenf" min="1" max="10000" value="<?php echo $item->count; ?>"></td>
              <td ><input type="number" style="width:100px;" class="form-control form-control-sm greenf" min="0" max="<?php echo $item->count; ?>" value="<?php echo $item->using; ?>"></td>
              <td> <a class='btn btn-sm col-auto ms-2 addEq' title="Сохранить изменения"><img width="20px" src='../images/check.png'></a></td>
              <td> <a class='btn btn-sm col-auto ms-2 cancelEq' title="Удалить запись"><img width="20px" src='../images/cancel.png'></a></td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>
    </div>

    <div class="row p-2 mt-1 mx-1 bg-light rounded eqLineAdd">
      <div class="col-auto">
        Наименование
        <input type="text" class="form-control form-control-sm greenf mt-1" placeholder="...">
      </div>
      <div class="col-auto">
        Количество (всего)
        <input type="number"  style="width:80px;" class="form-control form-control-sm greenf mt-1" min="1" max="10000" placeholder="50" />
      </div>
      <div class="col-auto">
        Используется (единиц)
        <input type="number" style="width:80px;" class="form-control form-control-sm greenf mt-1" min="0" max="10000" placeholder="2" />
      </div>
      <div class="col-auto">
        <br><a class="btn btn-outline-dark ms-2 btn-sm submit-add-eq mt-1">Добавить</a>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>