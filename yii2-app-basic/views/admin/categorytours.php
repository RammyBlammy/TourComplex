<?php

// /** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;
?>
<div class="container">
  <?php $form1 = ActiveForm::begin([
    'id' => 'cat-form',
    'options' => [],
  ]); ?>

  <div class="d-flex flex-column bd-highlight">

    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>" />
    <div class="overflow-auto mt-3 mb-1" style="max-height:70vh;">
      <table class="bg-light table table-striped table-hover rounded align-middle" id="category">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col" class="w-75">Категория</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($categ as $item) : ?>
            <tr>
              <td><input type="hidden" name="" value=""><?php echo $item->id; ?></td>
              <td contenteditable="true"><input type="hidden" name="" value=""><?php echo $item->name; ?></td>
              <td> <a class='btn btn-sm col-auto ms-2 addCat' title="Сохранить изменения"><img width="20px" src='../images/check.png'></a></td>
              <td> <a class='btn btn-sm col-auto ms-2 cancelCat' title="Удалить запись"><img width="20px" src='../images/cancel.png'></a></td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>
    </div>

    <div class="row p-2 mt-1 mx-1 bg-light rounded CatLineAdd">
      <div class="col-auto">
        Наименование
        <input type="text" class="form-control form-control-sm greenf mt-1" placeholder="...">
      </div>
      <div class="col-auto">
        <br><a class="btn btn-outline-dark ms-2 btn-sm submit-add-cat mt-1">Добавить</a>
      </div>
    </div>
    <?php ActiveForm::end(); ?>
  </div>
</div>