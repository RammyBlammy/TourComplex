<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\User;
use app\models\Food;
use app\models\menuStandart;
use app\models\menuPlus;
use app\models\menuChild;
use app\models\Equipment;
use app\controllers\HttpException;
use app\models\Apartment;
use app\models\CategoryTours;
use app\models\RelationTourCategory;
use app\models\Tours;
use app\models\DateTours;
use app\models\RoutesTours;
use app\models\Groups;
use app\models\GroupUsers;
use app\models\Room;
use app\models\Statuses;
use app\models\TypeRoom;
use Codeception\Lib\Generator\Group;

use function PHPUnit\Framework\isEmpty;

class AdminController extends Controller
{
    public $layout = 'adminmain';
    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                // 'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => [],
                        'allow' => true,
                        'roles' => ['@'],
                        'matchCallback' => function ($rule, $action) {
                            $access = false;
                            $user = Yii::$app->user->identity;
                            $access = $user->isUserAdmin();
                            return $access;
                        }
                    ]
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    public function actionTours()
    {
        $tours = Tours::find()->all();
        $categ = CategoryTours::find()->all();
        return $this->render('tours', ['tours' => $tours, 'categ' => $categ]);
    }

    public function actionFood()
    {
        $food = Food::find()->all();
        $menu = menuStandart::find()->all();
        return $this->render('food', ['menu' => $menu, 'food' => $food]);
    }

    public function actionLoad()
    {
        // echo "<pre>";
        if (Yii::$app->request->isAjax && $_POST['item']) {

            $menu = 0;
            switch ($_POST['item']) {
                case "Стандарт":
                    $menu = menuStandart::find()->asArray()->all();
                    // print_r($menu);
                    break;
                case "Плюс":
                    $menu = menuPlus::find()->asArray()->all();
                    break;
                case "Детское":
                    $menu = menuChild::find()->asArray()->all();
                    break;
            }
            //  print_r($menu);
            return json_encode($menu);
        }
    }

    public function actionSet()
    {
        // echo '<pre>';
        if (Yii::$app->request->isAjax && $_POST['text']) { //обновление таблицы menu{}
            $array = json_decode($_POST['text']);

            switch ($array[0]) {
                case "Стандарт":
                    $item = menuStandart::findOne(['foodId' => Food::findOne(['product' => $array[1]])->id]);
                    if (!$item) {
                        $item = new menuStandart();
                        $item->foodId = Food::findOne(['product' => $array[1]])->id;
                    }
                    break;
                case "Стандарт+":
                    $item = menuPlus::findOne(['foodId' => Food::findOne(['product' => $array[1]])->id]);
                    if (!$item) {
                        $item = new menuPlus();
                        $item->foodId = Food::findOne(['product' => $array[1]])->id;
                    }
                    break;
                case "Детское":
                    $item = menuChild::findOne(['foodId' => Food::findOne(['product' => $array[1]])->id]);
                    if (!$item) {
                        $item = new menuChild();
                        $item->foodId = Food::findOne(['product' => $array[1]])->id;
                    }
                    break;
            }
            // print_r(menuStandart::findOne(['foodId' => Food::findOne(['product' => $array[1]])->id]));       
            $item['1ed'] = $array[2];
            $item->unit = $array[3];
            $item->count = $array[4];
            $item->save();
        }
    }

    public function actionDeletemenu()
    {
        // echo '<pre>';
        if (Yii::$app->request->isAjax && $_POST['delElem']) { //обновление таблицы food
            $array = json_decode($_POST['delElem']);
            switch ($array[0]) {
                case "Стандарт":
                    $item = menuStandart::findOne(['foodId' => Food::findOne(['product' => $array[1]])]);
                    $item->delete();
                    break;
                case "Стандарт+":
                    $item = menuPlus::findOne(['foodId' => Food::findOne(['product' => $array[1]])]);
                    $item->delete();
                    break;
                case "Детское":
                    $item = menuChild::findOne(['foodId' => Food::findOne(['product' => $array[1]])]);
                    $item->delete();
                    break;
            }
        }
    }

    public function actionEquipment()
    {
        // $food = Food::find()->all();
        $equipm = Equipment::find()->all();
        return $this->render('equipment', ['equipm' => $equipm]);
    }

    public function actionApartment()
    {
        // $food = Food::find()->all();
        $apart = Apartment::find()->all();
        $types = TypeRoom::find()->all();
        $dates = Room::find()->all();
        return $this->render('apartment', ['apart' => $apart, 'types'=>$types, 'dates' =>$dates]);
    }

    public function actionAddequipm()
    {
        echo "<pre>";
        if (Yii::$app->request->isAjax && $_POST['']) { //обновление таблицы снаряжение
            $array = json_decode($_POST['eq']);
            $item = new Equipment();
            $item->name = $array[0];
            $item->count = $array[1];
            $item->using = $array[2];
            $item->save();
        }
    }

    public function actionAddrow()
    {
        if (Yii::$app->request->isAjax && $_POST['row']) { //обновление таблицы снаряжение
            $array = json_decode($_POST['row']);
            $item = Equipment::findOne(['id' => $array[0]]);
            $item->name = $array[1];
            $item->count = $array[2];
            $item->using = $array[3];
            $item->save();
        }
    }

    public function actionDeleteeq()
    {
        if (Yii::$app->request->isAjax && $_POST['id']) { //обновление таблицы снаряжение
            $item = Equipment::findOne(['id' => $_POST['id']]);
            $item->delete();
        }
    }

    public function actionCategorytours()
    {
        $categ = CategoryTours::find()->all();
        return $this->render('categorytours', ['categ' => $categ]);
    }

    public function actionAddcat()
    {
        if (Yii::$app->request->isAjax && $_POST['cat']) {
            $item = new CategoryTours();
            $item->name = $_POST['cat'];
            $item->save();
        }
    }

    public function actionUploadcat()
    {
        if (Yii::$app->request->isAjax && $_POST['cats']) {
            $array = json_decode($_POST['cats']);
            $item = CategoryTours::findOne(['id' => $array[0]]);
            $item->name = $array[1];
            $item->save();
        }
    }

    public function actionAddtour()
    {
        if (Yii::$app->request->isAjax && $_POST['tour']) {
            $array = json_decode($_POST['tour']);
            $item = new Tours();
            $item->name = $array[0];
            $item->hours = $array[1];
            $item->price = $array[2];
            $item->save();
        }
    }

    public function actionModal()
    {
        if (Yii::$app->request->isAjax && $_POST['tourid']) {
            $categoriesArray = RelationTourCategory::findAll(['tourId' => $_POST["tourid"]]);
            $categName = [];
            $output = [];
            foreach ($categoriesArray as $key => $value) {
                $categName[] = CategoryTours::findOne(["id" => $value['categoryId']])->name;
            }
            $output['one'] = $categName;
            $dates = DateTours::find()->where(['idTour' => $_POST["tourid"]])->asArray()->all();
            if (RoutesTours::findOne(['idTour' => $_POST["tourid"]]))
                $route = RoutesTours::findOne(['idTour' => $_POST["tourid"]])->name;
            else $route = "";
            $output['two'] = $dates;
            $output['three'] = $route;
            return json_encode($output);
        }
    }

    public function actionAddrelcat()
    {
        if (Yii::$app->request->isAjax && $_POST['out']) {
            $array = json_decode($_POST['out']);
            if (!RelationTourCategory::findOne(['categoryId' => CategoryTours::findOne(['name' => $array[1]]), 'tourId' => Tours::findOne(['name' => $array[0]])])) {
                $item = new RelationTourCategory();
                $item->tourId = Tours::findOne(['name' => $array[0]])->id;
                $item->categoryId = CategoryTours::findOne(['name' => $array[1]])->id;
                $item->save();
            } else die(header("HTTP/1.0 404 Not Found"));
        }
    }

    public function actionControl()
    {
        $admins = User::findAll(['role' => 20]);
        return $this->render('control', ['admins' => $admins]);
    }

    public function actionGroups()
    {
        $groups = Groups::find()->all();
        $tours = Tours::find()->all();
        $statuses = Statuses::find()->all();
        return $this->render('groups', ['groups' => $groups, 'tours' => $tours, 'statuses' => $statuses]);
    }

    public function actionGetdate()
    {
        if (Yii::$app->request->isAjax && $_POST['kred']) {
            return json_encode(DateTours::find()->where(['idTour' => $_POST['kred']])->asArray()->all());
        }
    }
    public function actionSetgroup()
    {
        if (Yii::$app->request->isAjax && $_POST['ret']) {
            $array = json_decode(($_POST['ret']));
            if (Groups::findOne(['idT' => $array[0]]) && Groups::findOne(['idDate' => $array[1]])){
            }
            else{
            $item = new Groups();
            $item->idT = $array[0];
            $item->idDate = $array[1];
            $item->CountMin = $array[3];
            $item->CountMax = $array[2];
            $item->CountCur = 0;
            $item->status = 1;
            $item->save();
            }
        }
    }

    public function actionGetlist()
    {
        if (Yii::$app->request->isAjax && $_POST['selectedItem']) {
            // print_r(GroupUsers::find()->where(['idGroup' =>$_POST['selectedItem']])->asArray()->all());
            return json_encode(GroupUsers::find()->where(['idGroup' =>$_POST['selectedItem']])->asArray()->all());
        }
    }

    public function actionUploaddate()
    {
        if (Yii::$app->request->isAjax && $_POST['w']) {
            $array = json_decode(($_POST['w']));
            $item = new DateTours();
            $item->idTour = Tours::findOne(['name' => $array[0]])->id;
            $item->start = $array[1];
            $item->end = $array[2];
            $item->days = $array[3];
            $item->save();
        }
    }

    public function actionGroupupload()
    {
        if (Yii::$app->request->isAjax && $_POST['ytr']) {
            $array = json_decode(($_POST['ytr']));
            $item = Groups::findOne(['id'=>$array[0]]);
            $item->CountMin = $array[1];
            $item->CountMax = $array[2];
            
            $item->CountCur = $array[3];
            $item->status = $array[4];
            $item->save();
        }
    }

    public function actionGetroom()
    {
        if (Yii::$app->request->isAjax && $_POST['room']) {
           return json_encode(Room::find()->where(['idApart' => $_POST['room']])->asArray()->all());
        }
    }
}
