<?php

namespace app\modules\user\controllers;

use Yii;
use app\modules\user\models\User;
use app\modules\user\models\search\UserSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\helpers\Json;

use app\components\BaseController;

/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends BaseController
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
        ];
    }
    
    public function actionTambah()
    {
        $model = new User();
        $manager = Yii::$app->authManager;
        $transaction = Yii::$app->db->beginTransaction();
        
        try {
            
            if ($model->load(Yii::$app->request->post())) {
                $model->password = Yii::$app->getSecurity()->generatePasswordHash($model->password);
                $model->create_date = date('Y-m-d');
                $model->create_time = date('H:i:s');

                if ($model->save()) {
                    $item = $manager->getRole($model->role);
                    $item = $item ? : $manager->getPermission($model->role);
                    $manager->assign($item, $model->id);
                
                    $transaction->commit();
                    return $this->redirect(['view', 'id' => $model->id]);
                } else {
                    throw new \yii\web\HttpException(400, Json::encode($model->getErrors()));
                }
                
            } else {
                return $this->render('create', [
                    'model' => $model,
                ]);
            }
            
        } catch (Exception $exc) {
            $transaction->rollBack();
        }

    }

    /**
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
        
        echo '<pre>';var_dump(User::find()->all());die;
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    

    /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing User model.
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
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
    
    public function actionProfile($id)
    {
        return $this->render('view_profile', [
            'model' => $this->findModel($id),
        ]);
    }
}
