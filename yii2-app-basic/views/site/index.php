<?php

/** @var yii\web\View $this */

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;
use yii\captcha\Captcha;
use yii\widgets\MaskedInput;

$this->title = 'Главная';
?>
<div class="container overflow-auto" style="height:70vh;">
  <div class="container row shadow p-2 m-auto">

    <div class="col-4">
      <br><br><br>
      <p>Современный человек часто испытывает потребность в свежих, бодрящих впечатлениях,
        меняющих привычную картинку будней. </p>
      <p>Находясь в Крыму,
        Вы попадаете в сосредоточение разнообразных видов активного
        отдыха: конных прогулок и поездок на квадроцикле, дайвинга и роуп-джампинга,
        полётов на параплане, альпинизма и т.д. </p>
      <h3 class="text-center">Время выбирать!</h3>
    </div>
    <div class="col-7 m-auto align-center">
      <div id="carouselExampleCaptions" class="carousel slide">
        <div class="carousel-indicators">
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
          <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
        </div>
        <div class="carousel-inner ">
          <div class="carousel-item active">
            <img src="../images/car1.jpg" class="img-fluid overflow-hidden" alt="...">
            <div class="carousel-caption d-none d-md-block ">
              <h5 class="bg-dark rounded-1" style="--bs-bg-opacity: .25;">Морские прогулки</h5>
              <p class="bg-dark rounded-1" style="--bs-bg-opacity: .35;">Отличный способ отдохнуть и развеяться, а также "окунуться" в морские глубины </p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../images/car2.jpg" class="img-fluid overflow-hidden" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5 class="bg-dark rounded-1" style="--bs-bg-opacity: .25;">Дайвинг, каякинг и не только</h5>
              <p class="bg-dark rounded-1" style="--bs-bg-opacity: .35;">Даже короткая прогулка откроет привычные виды с неизведанной стороны</p>
            </div>
          </div>
          <div class="carousel-item">
            <img src="../images/car3.jpg" class="img-fluid overflow-hidden" alt="...">
            <div class="carousel-caption d-none d-md-block">
              <h5 class="bg-dark rounded-1" style="--bs-bg-opacity: .25;">Конные прогулки</h5>
              <p class="bg-dark rounded-1" style="--bs-bg-opacity: .35;">Любование красотами края с грациозными и удивительными компаньонами</p>
            </div>
          </div>
        </div>
        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Previous</span>
        </button>
        <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    </div>

  </div>

  <div class="align-center w-25 m-auto mt-3">
    <a class='btn btn-lg btn-success mt-3' href="tours">Перейти к турам <img src='../images/arrow.png'></a>
  </div>
</div>