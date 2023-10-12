<?php

/** @var yii\web\View $this */

use app\models\DateTours;
use app\models\RelationTourCategory;
use app\models\RoutesTours;

$this->title = 'Туры';
?>
<div class="row p-2">
    <div class="col-md-3 shadow mt-2 mb-2">

        <form class="d-flex mt-3" role="search">
            <input class="form-control form-control-sm me-1 greenf" type="search" id="searchinput" placeholder="Поиск по названию" aria-label="Search">
            <a class="btn btn-sm btn-outline-success" id="loupe-tours"><img width='20px' src="../images/loupe.png" alt=""></a>
        </form><br>
        <button class="btn btn-success w-100 searchBut mt-2" type="button">Показать</button>
        <div>
            <label for="" class="mt-2">Категории</label>
            <ul class="list-group overflow-auto mt-1 mb-2 border" style="max-height:40vh;">
                <?php foreach ($category as $item) : ?>
                    <li class="list-group-item categories"><input class="form-check-input greenf me-1" type="checkbox" value="<?php echo $item->id; ?>" id="flexCheckDefault"><?php echo $item->name; ?></li>
                <?php endforeach ?>
            </ul>
        </div>

        <div>
            <label for="" class="mt-2">Количество дней</label>
            <ul class="list-group overflow-auto mt-1 mb-2 border" style="max-height:40vh;">
                <?php for ($i = 1; $i < 15; $i++) { ?>
                    <li class="list-group-item daystour"><input class="form-check-input greenf" type="checkbox" value="<?php echo $i; ?>" id="flexCheckDefault"> <?php echo $i; ?></li>
                <?php } ?>
            </ul>
        </div>
        <button class="btn btn-success w-100 searchBut mt-2" type="button">Показать</button>
    </div>

    <div class="col-md-9">
        <?php foreach ($tours as $item) : ?>
            <div class="card shadow border rounded-3 mt-2 mb-3" name="<?php echo $item->id; ?>">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                            <div class="bg-image hover-zoom ripple rounded ripple-surface">
                                <?php foreach ($images as $imf) :
                                    if ($imf->tour == $item->id) { ?>
                                        <img src="<?php echo $imf->image;
                                                }
                                            endforeach; ?>" class="w-100">
                                        <a href="#!">
                                            <div class="hover-overlay">
                                                <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                            </div>
                                        </a>
                            </div>
                        </div>
                        <div class="col-md-6 col-lg-6 col-xl-6">
                            <!-- название тура -->
                            <h5 class="nameoftour" name="<?php echo $item->id; ?>"><?php echo $item->name; ?></h5>
                            <div class="mt-1 mb-0 text-muted small">
                                <?php
                                $vew = RelationTourCategory::findAll(['tourId' => $item->id]);
                                foreach ($vew as $troi) : ?>
                                    <span class="text-primary"> • </span>
                                    <span class="categ"><?php echo $troi->categoryTours->name; ?></span>
                                <?php endforeach ?>
                            </div>
                            <?php $s = RoutesTours::findOne(['idTour' => $item->id]);
                            if ($s) { ?>
                                <p class="text-truncate mt-3 mb-4 mb-md-0"><?= $s->name;
                                                                        } else echo "Маршрут в разработке!";  ?> </p>
                        </div>
                        <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                            <div class=" mb-1">
                                <h4 class="mb-1 me-1 text-center"><?php echo $item->price; ?> руб.</h4>
                            </div>
                            <div class="mb-1 row">
                            <h6 class="mb-1 me-1 col text-end koldnei"><?php echo DateTours::findOne(['idTour' => $item->id])->days; ?> дн.</h6>
                                <span class="col text-center">- - • - - </span>
                                <h6 class="mb-1 me-1 col text-start"><?php echo $item->hours; ?> ч.</h6>
                            </div>
                            <div class="d-flex flex-column mt-4">
                                <button class="btn btn-success btn-sm openModalUser" name="<?php echo $item->id; ?>" type="button" data-bs-toggle="modal" data-bs-target="#ModalTour">Просмотреть</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>


    <div class="modal fade" id="ModalTour" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl modal-dialog-scrollable" style=" max-height:80vh;" id="myModal">
            <div class="modal-content ">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel"><img src="..\images\route.png"> Карта тура</h5>
                    <button type="button" class="btn-close greenf" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="forContent">

                    <div class="row">

                        <div class="col-lg-6 col-md-auto border-end">
                            <div class="form-row ">
                                <div class="form-group col  mt-1 mb-2">
                                    <label>Название тура</label>
                                    <input type="text" class="form-control w-100 greenf border border-dark" id="UserinputTour" placeholder="..." disabled>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="form-group col">
                                    <label>Маршрут</label>
                                    <textarea class="form-control greenf border border-dark" id="UserRoutes" rows="6" disabled></textarea>
                                </div>
                                <div class="form-group col-md-11 my-2 ">

                                    <label>Даты проведения</label>
                                    <table class="table table-striped table-hover border border-dark align-middle" id="UserTime">
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
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-auto">
                            <h5 class="text-center">Оформление заявки</h5>
                            <div class="me-2">
                                <div class="row">
                                    <label class="col-md-4">Начало тура</label>
                                    <input type="hidden"  id="hiddenInputId" value="">
                                    <input type="text" class="form-control border-0 border-bottom col" id="startTour" value="-----" disabled>
                                </div>
                                <div class="row">
                                    <label class="col-md-4">Конец тура</label>
                                    <input type="text" class="form-control border-0 border-bottom col" id="endTour" value="-----" disabled>
                                </div>
                                <div class="row">
                                    <label class="col-md-4">Дней</label>
                                    <input type="text" class="form-control border-0 border-bottom col" id="daysTour" value="-----" disabled>
                                </div>
                                <div class="row">
                                    <label class="col-md-4 text-danger">Свободных мест в группе:</label>
                                    <input type="text" class="form-control border-0 border-bottom col text-danger" id="Places" value="-----" disabled>
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-auto">
                                    Человек
                                    <input type="number" style="width:80px;" class="form-control form-control-sm greenf mt-1" id="CountPeop" min="1" max="100" placeholder="2" default="1" disabled><label class="text-danger" id='DangerText'></label>
                                </div>
                            </div> 
                            <div class="me-2">
                                <h5 class="text-center">Выбор меню</h5>
                                <div class="row m-2 border">
                                    <label class="col-md-8 mt-3">Стандарт</label>
                                    <input type="number" class="form-control border-0 border-bottom border-success m-2 col greenf" id="menu1" min="0" value="0">
                                    <div class="overflow-auto me-2" style="max-height:20vh;">
                                        <table class='table-bordered w-100 border-success'>
                                            <thead>
                                                <tr>
                                                    <th scope="col">Продукт</th>
                                                    <th scope="col">Единица</th>
                                                    <th scope="col">Ед. изм.</th>
                                                    <th scope="col">Кол-во</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($standart as $item) : ?>
                                                    <tr>
                                                        <td><?php echo $item->food->product; ?></td>
                                                        <td><?php echo $item['1ed']; ?></td>
                                                        <td><?php echo $item->unit; ?></td>
                                                        <td><?php echo $item->count; ?></td>
                                                    </tr>
                                                <?php endforeach ?>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row m-2 border">
                                    <label class="col-md-8 mt-3">Стандарт Плюс</label>
                                    <input type="number" class="form-control border-0 border-bottom border-success m-2 col greenf" id="menu2" min="0" value="0">
                                    <div class="overflow-auto me-2" style="max-height:20vh;">
                                        <table class="table-bordered w-100 border-success">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Продукт</th>
                                                    <th scope="col">Единица</th>
                                                    <th scope="col">Ед. изм.</th>
                                                    <th scope="col">Кол-во</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($plus as $item) : ?>
                                                    <tr>
                                                        <td><?php echo $item->food->product; ?></td>
                                                        <td><?php echo $item['1ed']; ?></td>
                                                        <td><?php echo $item->unit; ?></td>
                                                        <td><?php echo $item->count; ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="row m-2 border">
                                    <label class="col-md-8 mt-3">Детское</label>
                                    <input type="number" class="form-control m-1 form-control-sm border-0 border-bottom border-success m-2 col greenf" id="menu3" min="0" value="0">
                                    <div class="overflow-auto me-2" style="max-height:20vh;">
                                        <table class="table-bordered w-100 border-success">
                                            <thead>
                                                <tr>
                                                    <th scope="col">Продукт</th>
                                                    <th scope="col">Единица</th>
                                                    <th scope="col">Ед. изм.</th>
                                                    <th scope="col">Кол-во</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php foreach ($child as $item) : ?>
                                                    <tr>
                                                        <td><?php echo $item->food->product; ?></td>
                                                        <td><?php echo $item['1ed']; ?></td>
                                                        <td><?php echo $item->unit; ?></td>
                                                        <td><?php echo $item->count; ?></td>
                                                    </tr>
                                                <?php endforeach ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div class="d-flex justify-content-center"><a class="btn btn-success" id="sendRequest">Оставить заявку</a>
                                    
                                    </div>

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
</div>