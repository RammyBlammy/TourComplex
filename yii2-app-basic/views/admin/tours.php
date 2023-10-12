<?php

// /** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;
?>
<div class="container">
  <?php $form1 = ActiveForm::begin([
    'id' => 'tours-form',
    'options' => [],
  ]); ?>

  <div class="d-flex flex-column bd-highlight">

    <input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>" />
    <div class="overflow-auto mt-3 mb-1" style="max-height:70vh;">
      <table class="bg-light table table-striped table-hover rounded align-middle" id="tours">
        <thead>
          <tr>
            <th scope="col">id</th>
            <th scope="col" class="w-50">Тур</th>
            <th scope="col">Часы</th>
            <th scope="col">Цена (руб.)</th>
            <th scope="col"></th>
            <th scope="col"></th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tours as $item) : ?>
            <tr>
              <td><input type="hidden" name="" value=""><?php echo $item->id; ?></td>
              <td contenteditable="true"><input type="hidden" name="" value=""><?php echo $item->name; ?></td>
              <td><input type="number" style="width:100px;" class="form-control form-control-sm greenf" min="1" max="500" value="<?php echo $item->hours; ?>"></td>
              <td><input type="number" style="width:100px;" class="form-control form-control-sm greenf" min="1" max="1000000" value="<?php echo $item->price; ?>"></td>
              <td> <a class='btn btn-sm col-auto ms-2' id="modalOpenBut" title="Просмотреть карту тура" data-bs-toggle="modal" data-bs-target="#staticBackdrop"><img width="20px" src='../images/map1.png'></a></td>
              <td> <a class='btn btn-sm col-auto ms-2 addT' title="Сохранить изменения"><img width="20px" src='../images/check.png'></a></td>
              <td> <a class='btn btn-sm col-auto ms-2 cancelT' title="Удалить запись"><img width="20px" src='../images/cancel.png'></a></td>
            </tr>
          <?php endforeach ?>

        </tbody>
      </table>
    </div>

    <div class="row p-2 mt-1 mx-1  bg-light rounded TLineAdd">
      <div class="col-7">
        Название тура
        <input type="text" class="form-control form-control-sm greenf mt-1" placeholder="...">
      </div>
      <div class="col-auto">
        Кол-во часов
        <input type="number" style="width:80px;" class="form-control form-control-sm greenf mt-1" min="1" max="10000" placeholder="50" />
      </div>
      <div class="col-auto">
        Цена (руб.)
        <input type="number" style="width:80px;" class="form-control form-control-sm greenf mt-1" min="1" max="1000000" placeholder="2000" />
      </div>
      <div class="col-auto">
        <br><a class="btn btn-outline-dark ms-2 btn-sm submit-add-t mt-1">Добавить</a>
      </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
      <div class="modal-dialog modal-lg modal-dialog-scrollable" style=" max-height:80vh;" id="myModal">
        <div class="modal-content ">
          <div class="modal-header">
            <h5 class="modal-title" id="staticBackdropLabel">Карта тура</h5>
            <button type="button" class="btn-close greenf" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body" id="forContent">
            <div class="form-row">
              <div class="form-group col  mt-1 mb-2">
                <label class = "mb-2">Название тура</label><a class="btn btn-outline-dark btn-sm mb-2 ms-2" id="CategoryAdd"> Сохранить</a>
                <input type="text" class="form-control w-100 greenf border border-dark" id="inputName" placeholder="...">
              </div>
              <div class="form-group col-md-8  mt-1 mb-2">
                <label>Категории тура</label>
                <table class="table table-striped table-hover border border-dark align-middle" id="tableCategory">
                  <thead>
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Категория</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>

              </div>
            </div>

            <div class="form-group row">
              <div class="col">
                <select class="form-select form-select-sm greenf border border-dark" id="selectCategory" aria-label=".form-select-sm">
                  <?php foreach ($categ as $item) : ?>
                    <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
                  <?php endforeach ?>
                </select>
              </div>
              <div class="col">
                <a class="btn btn-outline-dark btn-sm" id="CategoryAdd">Добавить категорию</a>
              </div>
            </div>
            <div class="form-group my-2">
              <label>Часы</label>

              <input type="text" class="form-control w-auto greenf border border-dark" id="inputHours" placeholder="..." disabled>
              <label>Цена (руб.)</label>
              <input type="text" class="form-control w-auto greenf border border-dark" id="inputPrice" placeholder="..." disabled>
            </div>
            <div class="form-row">
              <div class="form-group col">
                <label class = "mb-2">Маршрут</label> <a class="btn btn-outline-dark btn-sm mb-2 ms-2" >Сохранить</a>
                <textarea class="form-control greenf border border-dark" id="Routes" rows="3"></textarea>
              </div>
              <div class="form-group col-md-8 my-2 ">
                <label>Даты проведения</label>
                <table class="table table-striped table-hover border border-dark align-middle" id="tableTime">
                  <thead>
                    <tr>
                      <th scope="col">Начало</th>
                      <th scope="col">Конец</th>
                      <th scope="col">Дней</th>
                      <th scope="col"></th>
                    </tr>
                  </thead>
                  <tbody>
                  </tbody>
                </table>
                <div class="row p-2 mt-1 mx-1  bg-light rounded">
                  <div class="col">
                    Начало
                    <input type="date" name="" id="modalDateStart" class="form-control form-control-sm greenf">
                  </div>
                  <div class="col">
                    Конец
                    <input type="date" name="" id="modalDateEnd" class="form-control form-control-sm greenf">
                  </div>
                  <div class="col">
                    Дней
                    <input type="number" id="modalDateDays" style="width:80px;" class="form-control form-control-sm greenf mt-1" min="1" max="1000000" />
                  </div>
                  <div class="col">
                    <br><a class="btn btn-outline-dark ms-2 btn-sm mt-1" id="modalDateUpload">Добавить</a>
                  </div>
                </div>
                
              </div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Закрыть</button>
            </div>
          </div>
        </div>
      </div>
      <?php ActiveForm::end(); ?>
    </div>
  </div>