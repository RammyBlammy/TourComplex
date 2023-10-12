<?php

/** @var yii\web\View $this */

$this->title = 'Номера';
?>

<div class="row">
    <div class="col-md-1"></div>
    <div class="col">
        <div class="row p-2 mt-1 mx-1 bg-light rounded border border-success d-flex justify-content-center">
            <div class="col bg-warning rounded-end" ></div>
            <div class="col-auto border-top border-bottom border-warning border-3 ms-2 p-1">
                Места
                <input type="number" style="width:80px;" class="form-control form-control-sm greenf" id="searchPlace" min="1" max="10000" placeholder="2" />
            </div>
            <div class="col-auto border-top border-bottom border-warning border-3 p-1">
                Дата въезда
                <input type="date" class="form-control form-control-sm greenf" value="" id="searchIn">
            </div>
            <div class="col-auto border-top border-bottom border-warning border-3 p-1">
                Дата выезда
                <input type="date" class="form-control form-control-sm greenf" value="" id="searchOut">
            </div>
            <div class="col-auto border-top border-bottom border-warning border-3 me-2 p-1">
                <a class="btn btn-outline-dark ms-2 btn-sm mt-4" id="confirmsearch">Найти</a>
            </div>
            <div class="col bg-warning rounded-start"></div>
        </div>
        <?php foreach ($ap as $item) : ?>
            <div class="card shadow border rounded-3 mt-2 mb-3 roomsToReserv" name="<?php echo $item->id; ?>" >
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-9 col-lg-auto col-xl-9">
                            <h5 class="p-1 bg-dark text-light rounded-end rounded-3 RoomCom" id="<?php echo $item->id; ?>">Комната "<?php echo $item->typeRoom->name; echo '" '.$item->count; ?>-местная</h5>
                            <div class="row w-50">
                                <h6 class="col-auto mt-2">Этаж: <?php echo $item->floor; ?></h6>
                                <span class="col-auto"> <img width="20px" src="../images/star.png" alt=""> </span>
                                <h6 class="col-auto mt-2">Площадь: <?php echo $item->area; ?> кв. м.</h6>
                            </div>
                            
                            <p class="word-wrap mt-3 mb-4 mb-md-9"><?php if ($item->descrip != NULL) echo $item->descrip; ?></p>
                        </div>
                        <div class="col-md-9 col-lg-3 col-xl-3 border-sm-start-none border-start">
                            <div class=" mb-1">
                                <h4 class="mb-1 me-1 text-center"><?php echo $item->price; ?> руб.</h4>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-auto"></div>
                                <span class="col text-center">- - - - • - - - -</span>
                                <div class="col-auto"></div>
                            </div>
                            <div class="d-flex flex-column mt-4">
                                <button class="btn btn-outline-dark btn-sm setReservation" name="<?php echo $item->id; ?>" type="button" disabled>Забронировать</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        <?php endforeach ?>
    </div>
    <div class="col-md-1"></div>
</div>
