<?php

namespace backend\controllers;

use Yii;
use common\models\HotelBooking;
use backend\models\search\HotelBookingSearch;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * HotelBookingController implements the CRUD actions for HotelBooking model.
 */
class HotelBookingController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['post'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['index'],
            ]
        ];
    }


    /**
     * Lists all HotelBooking models.
     * @return mixed
     */
//    public function actionIndex()
//    {
//        $searchModel = new HotelBookingSearch();
//        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,false);
//
//        return $this->render('index', [
//            'searchModel' => $searchModel,
//            'dataProvider' => $dataProvider,
//        ]);
//    }

    public function actionConfirmed(){
        $searchModel = new HotelBookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,true);

        return $this->render('confirmed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionNonConfirmed(){
        $searchModel = new HotelBookingSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams,false);

        return $this->render('non-confirmed', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    public function actionConfirm($id = null){
        if($id){
            $hotelbooking = HotelBooking::find()->byId($id)->one();
            if($hotelbooking->confirm()){
                return $this->redirect('/hotel-booking/confirmed');
            }
        }else{

            return $this->redirect('/hotel-booking/non-confirmed');
        }
    }
    /**
     * Displays a single HotelBooking model.
     * @param integer $id
     * @return mixed
//     */
//    public function actionView($id)
//    {
//        return $this->render('view', [
//            'model' => $this->findModel($id),
//        ]);
//    }

    /**
     * Creates a new HotelBooking model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
//    public function actionCreate()
//    {
//        $model = new HotelBooking();
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('create', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Updates an existing HotelBooking model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
//    public function actionUpdate($id)
//    {
//        $model = $this->findModel($id);
//
//        if ($model->load(Yii::$app->request->post()) && $model->save()) {
//            return $this->redirect(['view', 'id' => $model->id]);
//        } else {
//            return $this->render('update', [
//                'model' => $model,
//            ]);
//        }
//    }

    /**
     * Deletes an existing HotelBooking model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the HotelBooking model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return HotelBooking the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = HotelBooking::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
