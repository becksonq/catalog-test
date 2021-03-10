<?php

namespace backend\controllers\product;

use catalog\models\currency\CurrencyService;
use catalog\models\product\ProductService;
use Yii;
use catalog\models\product\Product;
use catalog\models\product\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /** @var ProductService $_service */
    private $_service;

    /** @var CurrencyService $_currencyService */
    private $_currencyService;

    /**
     * ProductController constructor.
     * @param $id
     * @param $module
     * @param ProductService $service
     * @param CurrencyService $currencyService
     * @param array $config
     */
    public function __construct($id, $module, ProductService $service, CurrencyService $currencyService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_service = $service;
        $this->_currencyService = $currencyService;
    }

    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class'   => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
            'currencyList' => $this->_currencyService->currencyList(),
            'statusList'   => $this->_service->statusList(),
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();
        $currencyList = $this->_currencyService->currencyList();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model'        => $model,
            'currencyList' => $currencyList,
        ]);
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $currencyList = $this->_currencyService->currencyList();

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
            'currencyList' => $currencyList,
        ]);
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        if ($model->status == Product::STATUS_ACTIVE) {
            Yii::$app->session->setFlash('danger', 'Нельзя удалить активный товар!');
            return $this->redirect(['index']);
        } else {
            $model->delete();
        }

        return $this->redirect(['index']);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }

    /**
     * Меняем статус продукта
     *
     * @param int $status
     * @param int $id
     * @return \yii\web\Response
     * @throws NotFoundHttpException
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function actionStatus(int $status, int $id)
    {
        $model = $this->findModel($id);
        if ($model->price == null) {
            Yii::$app->session->setFlash('danger', 'Установите цену!');
            return $this->redirect(['index']);
        }
        $model->status = $status == 0 ? 1 : 0;
        $model->update(false);
        return $this->redirect(['index']);
    }
}
