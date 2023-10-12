<?php

namespace app\controllers;

use AllowDynamicProperties;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\User;
use app\models\SignupForm;
use app\controllers\HttpException;
use app\models\Apartment;
use app\models\CategoryTours;
use app\models\Clients;
use app\models\DateTours;
use app\models\Groups;
use app\models\GroupUsers;
use app\models\RelationTourCategory;
use app\models\Tours;
use app\models\Images;
use app\models\menuChild;
use app\models\menuPlus;
use app\models\menuStandart;
use app\models\Room;

class UserController extends Controller
{
    public $layout = 'usermain';

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $user = Yii::$app->user->identity;
        if (!Clients::findOne(['userId' => $user->id]))
            return $this->render('index', ['show' => 1]);
        else
            return $this->render('index', ['show' => 0]);
        // return $this->render('index');
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
                            $access = !($user->isUserAdmin());
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

    public function actionClient()
    {
        if (Yii::$app->request->isAjax && $_POST['anketa']) {
            $array = json_decode($_POST['anketa']);
            $item = new Clients();
            $item->userId = Yii::$app->user->identity->id;
            $item->Familia = $array[0];
            $item->Imya = $array[1];
            $item->Otchestvo = $array[2];
            $item->birthday = $array[3];
            $item->phone = $array[4];
            $item->save();
            return $this->render('index', ['show' => 0]);
        }
    }
    public function actionTours()
    {
        $tours = Tours::find()->all();
        $categ = CategoryTours::find()->all();
        $images = Images::find()->all();
        $standart = menuStandart::find()->all();
        $plus = menuPlus::find()->all();
        $child = menuChild::find()->all();
        return $this->render('tours', ['tours' => $tours, "category" => $categ, 'images' => $images, 'standart' => $standart, 'plus' => $plus, 'child' => $child]);
    }


    public function actionApartment()
    {
        $ap = Apartment::find()->all();
        return $this->render('apartment', ['ap' => $ap]);
    }

    public function actionSearchrooms()
    {
        if (Yii::$app->request->isAjax && $_POST['ewq']) {
            $array = json_decode($_POST['ewq']);
            $apartments =  Apartment::find()->where([">=",'count', $array[0]])->all();
            $free_apartments = [];
            foreach($apartments as $apartment){
                if(!$apartment->isFree($array[1], $array[2])){
                    $free_apartments[] = $apartment->id;
                }
            }

            return json_encode($free_apartments);
        }
    }

    public function actionReservation()
    {
        if (Yii::$app->request->isAjax && $_POST['yui']) {
            $array = json_decode($_POST['yui']);
            $item = new Room();
            $item->idCli = Clients::findOne(['userId' => Yii::$app->user->identity->id])->id;
            $item->idApart = $array[0];
            $item->dateIn = $array[1];
            $item->dateOut = $array[2];
            $item->save();
        }
    }

    public function actionGetdate()
    {
        if (Yii::$app->request->isAjax && $_POST['time']) {
            $array = DateTours::find()->where(['idTour' => $_POST['time']])->asArray()->all();
            return json_encode($array);
        }
    }

    public function actionProfile()
    {
        $client = Clients::findOne(['userId' => Yii::$app->user->identity->id]);
        if ($client) {
            $broni = GroupUsers::findAll(['idClient' => $client->id]);
            $reservation = Room::findAll(['idCli' => $client->id]);
            return $this->render('profile', ['client' => $client, 'broni' => $broni, 'reserv' => $reservation]);
        } else
            return $this->render('index');
    }

    public function actionGetgroup()
    {
        if (Yii::$app->request->isAjax && $_POST['group']) { //id даты 
            $elem = Groups::findOne(['idDate' => $_POST['group']]);
            if ($elem) {
                return ($elem->CountMax - $elem->CountCur);
            } else return '-100';
        }
    }

    public function actionSetrequest()
    {
        if (Yii::$app->request->isAjax && $_POST['rrt']) { //id даты 
            $array = json_decode($_POST['rrt']);
            if (GroupUsers::findOne(['idClient' => Clients::findOne(['userId' => Yii::$app->user->identity->id])->id, 'idGroup' => Groups::findOne(['idDate' => $array[0]])->id])) {
                return "error";
            } else {

                $item = new GroupUsers();
                $item->idGroup = Groups::findOne(['idDate' => $array[0]])->id;
                $item->idClient = Clients::findOne(['userId' => Yii::$app->user->identity->id])->id;
                $item->count = $array[1];
                $item->menuStand = $array[2];
                $item->menuPl = $array[3];
                $item->menuCh = $array[4];
                if ($item->save()) {
                    $gr = Groups::findOne(['idDate' => $array[0]]);
                    $gr->CountCur =  $gr->CountCur + $array[1];
                    $gr->save();
                }
            }
        }
    }

    public function actionChangeuser()
    {
        if (Yii::$app->request->isAjax && $_POST['rizz']) { //id даты 
            $array = json_decode($_POST['rizz']);
            $item = Clients::findOne(['userId' => Yii::$app->user->identity->id]);
            $item->Familia = $array[1];
            $item->Imya = $array[0];
            $item->Otchestvo =  $array[2];
            $item->phone = $array[4];
            $item->save();
            $item2 = User::findOne(['id' => Yii::$app->user->identity->id]);
            $item2->username = $array[3];
            $item2->save();
        }
    }
}
