<?php

/** @var yii\web\View $this */

use app\models\Apartment;
use app\models\RoutesTours;
use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;
use yii\widgets\MaskedInput;

$this->title = 'Главная';
?>
<div class="container ">
    <h5 class="text-center">Информация о пользователе</h5>
    <div class="row">
        <div class="col shadow m-2">
            <div class="col-12 text-end">
                <a class='btn btn-sm' id="AllowEdit"><img src="../images/edit.png" width="20px"></a>
            </div>
            <h6 class="text-center">ФИО</h6>
            <div class="row">
                <input type="text"  id="UserFamInput" value="<?php echo $client->Familia; ?>" class="form-control col m-2 greenf shadow" disabled>
                <input type="text" id="UserImInput" value="<?php echo $client->Imya; ?>" class="form-control col m-2 greenf shadow" disabled>
                <input type="text"  id="UserOtInput" value="<?php echo $client->Otchestvo; ?>" class="form-control col m-2 greenf shadow" disabled>
            </div>
            <div class="row mt-4">
                <div class="col">
                    <h6>Имя пользователя</h6>
                    <input type="text" name="" id="UsernameInput" value="<?php echo $client->user->username; ?>" class="form-control greenf shadow" disabled>
                </div>
                <div class="col">
                    <h6>Номер телефона</h6>
                    <?php echo MaskedInput::widget([
                        'id' => 'UserPhoneinput',
                        'name' => 'phone',
                        'mask' => '+9(999)999-99-99',
                        'value' => $client->phone,
                        'options' => [
                            'class' => 'form-control greenf shadow',

                            'disabled' => true,
                        ],
                    ]); ?>
                </div>
            </div>
        </div>
        <div class="col shadow m-1">
            <h5 class="text-center">Забронированные туры</h5>
            <h6 class="text-danger">Отменить бронь можно только связавшись с администратором!*</h6>
            <div class="list-group overflow-auto" style="height:50vh;">
             <?php foreach ($broni as $item) : ?>
                <div class="mb-3 list-group-item list-group-item-action flex-column align-items-start shadow">
                    <div class="d-flex w-100 justify-content-between">
                        <h4 class="mb-1"><?php echo $item->groups->tours->name; ?></h4>
                        <small class="text-decoration-underline fw-bold"><?= $item->count; ?> чел.</small>
                        <small class="text-decoration-underline fw-bold"><?= $item->groups->dateTours->start;?> - <?= $item->groups->dateTours->end;?></small>
                        
                    </div>
                    <p class="mb-1">Маршрут: <?php $e = RoutesTours::findOne(['idTour'=>$item->groups->idT]);
                    if ($e) echo $e->name;?></p>
                    <small  class="fw-bold">Номер группы: <?php echo $item->idGroup; ?></small>
                </div>
                 <?php endforeach ?> 
            </div>
            <div class="col"></div>
        </div>
    </div>
    <div class="w-75 shadow rounded m-auto mt-2">
    <h5 class="text-center">Забронированные номера</h5>
    <h6 class="text-danger ms-2">Отменить бронь можно только связавшись с администратором!*</h6>
    <div class="list-group overflow-auto m-3" style="height:50vh;">
             <?php foreach ($reserv as $item) : 
                
                $typ = Apartment::findOne(['id'=>$item->idApart]); ?>
                <div class="mb-3 list-group-item list-group-item-action flex-column align-items-start shadow">
                    <div class="d-flex w-100 justify-content-between">
                        <h4 class="mb-1">Комната типа "<?= $typ->typeRoom->name; ?>" на <?= $typ->count; ?> места</h4>
                        <small class="text-decoration-underline fw-bold"><?= $typ->count; ?> чел.</small>
                        <small class="text-decoration-underline fw-bold"><?= $item->dateIn;?> - <?= $item->dateOut;?></small>
                        
                    </div>
                    <p class="text-wrap mb-1"> <?=$typ->descrip; ?></p>
                </div>
                 <?php endforeach ?> 
            </div>
    </div>
</div>