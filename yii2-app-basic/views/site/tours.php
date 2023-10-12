<?php

/** @var yii\web\View $this */

use app\models\DateTours;
use app\models\RelationTourCategory;
use app\models\RoutesTours;

$this->title = 'Туры';
?>
<div class="overflow-auto" style="height:80vh;">
    <?php foreach ($tours as $item) : ?>
        <div class="card shadow border rounded-3 mt-2 mb-3">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 col-lg-3 col-xl-3 mb-4 mb-lg-0">
                        <div class="bg-image hover-zoom ripple rounded ripple-surface">
                            <?php foreach ($images as $imf) :
                                if ($imf->tour == $item->id) { ?>
                                    <img src="<?php echo $imf->image;
                                            }
                                        endforeach; ?>" class="w-100" />
                                    <a href="#!">
                                        <div class="hover-overlay">
                                            <div class="mask" style="background-color: rgba(253, 253, 253, 0.15);"></div>
                                        </div>
                                    </a>
                        </div>
                    </div>
                    <div class="col-md-6 col-lg-6 col-xl-6">
                        <!-- название тура -->
                        <h5><?php echo $item->name; ?></h5>
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
                            <p class="mt-3 mb-4 mb-md-0"><?= $s->name;
                                                        } else echo "Маршрут в разработке!";  ?> </p>
                    </div>
                    <div class="col-md-6 col-lg-3 col-xl-3 border-sm-start-none border-start">
                        <div class=" mb-1">
                            <h4 class="mb-1 me-1 text-center"><?php echo $item->price; ?> руб.</h4>
                        </div>
                        <div class="mb-1 row">
                            <h6 class="mb-1 me-1 col text-end"><?php echo DateTours::findOne(['idTour' => $item->id])->days; ?> дн.</h6>
                            <span class="col text-center">- - • - - </span>
                            <h6 class="mb-1 me-1 col text-start"><?php echo $item->hours; ?> ч.</h6>
                        </div>
                        <div class="d-flex flex-column mt-4">
                            <button class="btn btn-success btn-sm " name="<?php echo $item->id; ?>" type="button">Доступно для зарегистрированных пользователей</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php endforeach ?>
</div>