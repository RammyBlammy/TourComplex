<?php

// /** @var yii\web\View $this */

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use yii\widgets\Pjax;
?>
<?php $form1 = ActiveForm::begin([
    'id' => 'tours-form',
    'options' => [],
]); ?>
<input type="hidden" name="<?= Yii::$app->request->csrfParam ?>" value="<?= Yii::$app->request->getCsrfToken() ?>" />
<div class="overflow-auto mt-3 mb-1" style="max-height:70vh;">
    <table class="bg-light table table-striped table-hover rounded align-middle" id="">
        <thead>
            <tr>
                <th scope="col">id группы</th>
                <th scope="col">Тур</th>
                <th scope="col">Начало</th>
                <th scope="col">Конец</th>
                <th scope="col">Мин. человек</th>
                <th scope="col">Макс. человек</th>
                <th scope="col">Текущее кол-во</th>
                <th scope="col">Статус</th>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($groups as $item) : ?>
                <tr>
                    <td><input type="hidden" name="" value=""><?php echo $item->id; ?></td>
                    <td><input type="hidden" name="" value=""><?php echo $item->tours->name; ?></td>
                    <td><input type="hidden" name="" value=""><?php echo $item->dateTours->start; ?></td>
                    <td><input type="hidden" name="" value=""><?php echo $item->dateTours->end; ?></td>
                    <td><input type="number" style="width:50px;" class="form-control form-control-sm greenf" min="1" max="500" value="<?php echo $item->CountMin; ?>"></td>
                    <td><input type="number" style="width:50px;" class="form-control form-control-sm greenf" min="1" max="1000" value="<?php echo $item->CountMax; ?>"></td>
                    <td><input type="number" style="width:50px;" class="form-control form-control-sm greenf" min="1" max="1000" value="<?php echo $item->CountCur; ?>"></td>
                    <td><select class="form-select form-select-sm greenf border border-dark selectGroup">
                            <?php foreach ($statuses as $item1) : ?>
                                <option value="<?php echo $item1->id; ?>" <?php if ($item1->id == $item->status) echo 'selected' ?>><?php echo $item1->name; ?></option>
                            <?php endforeach ?>
                    </select></td>
                    <td> <a class='btn btn-sm col-auto ms-2 modalGroupOpen' title="Состав группы" data-bs-toggle="modal" data-bs-target="#modalGroupList"><img width="20px" src='../images/list.png'></a></td>
                    <td> <a class='btn btn-sm col-auto ms-2 saveGroup' title="Сохранить изменения"><img width="20px" src='../images/check.png'></a></td>
                    <td> <a class='btn btn-sm col-auto ms-2 cancelthisgroup' title="Удалить запись"><img width="20px" src='../images/cancel.png'></a></td>
                </tr>
            <?php endforeach ?>
        </tbody>
    </table>
</div>

<div class="row p-2 mt-1 mx-1  bg-light rounded">
    <div class="col-7 row mt-1">
        Тур
        <select class="ms-3 form-select form-select-sm greenf border border-dark  col" id="selectTourGroup" aria-label=".form-select-sm">
            <?php foreach ($tours as $item) : ?>
                <option value="<?php echo $item->id; ?>"><?php echo $item->name; ?></option>
            <?php endforeach ?>
        </select>
        <a class="btn btn-outline-dark ms-2 btn-sm col" id="Uploadinfo">Загрузить даты</a>
    </div>

    <div class="col-7">
        Даты проведения тура
        <select class="form-select form-select-sm greenf border border-dark mt-1 selectDateGroup" aria-label=".form-select-sm">

        </select>
    </div>
    <div class="col-auto">
        Макс. чел.
        <input type="number" style="width:80px;" class="form-control form-control-sm greenf mt-1" id="MaxPeop" min="1" max="100" placeholder="13" />
    </div>
    <div class="col-auto">
        Мин.чел
        <input type="number" style="width:80px;" class="form-control form-control-sm greenf mt-1" id="MinPeop" min="1" max="100" placeholder="7" />
    </div>
    <div class="col-auto">
        <br><a class="btn btn-outline-dark ms-2 btn-sm mt-1" id="ItemGroupAdd">Добавить</a>
    </div>
</div>

<div class="modal fade" id="modalGroupList" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-scrollable" style=" max-height:80vh;">
        <div class="modal-content ">
            <div class="modal-header row">
                <h5 class="modal-title col" id="titleModal"></h5>
                <button type="button" class="btn-close greenf me-3" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="forContent">
               
            
            <div class="m-2">
                    <label>Список участников</label>
                    <table class="table table-striped table-hover border border-dark align-middle text-center" id="tableClients">
                        <thead>
                            <tr>
                                <th scope="col">id клиента</th>
                                <th scope="col">Чел.</th>
                                <th scope="col">Меню стандарт (шт)</th>
                                <th scope="col">Меню + (шт)</th>
                                <th scope="col">Меню детское (шт)</th>
                                <th scope="col">Подтверждение</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
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