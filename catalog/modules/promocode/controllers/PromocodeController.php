<?php

namespace catalog\modules\promocode\controllers;

use catalog\models\product\ProductService;
use catalog\modules\promocode\models\PromocodeForm;
use catalog\modules\promocode\models\PromocodeService;
use Yii;
use catalog\modules\promocode\models\Promocode;
use catalog\modules\promocode\models\PromocodeSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * PromocodeController implements the CRUD actions for Promocode model.
 */
class PromocodeController extends Controller
{
    /** @var PromocodeService $_service */
    private $_service;

    /** @var ProductService $_productService */
    private $_productService;

    /**
     * PromocodeController constructor.
     * @param $id
     * @param $module
     * @param PromocodeService $service
     * @param ProductService $productService
     * @param array $config
     */
    public function __construct($id, $module, PromocodeService $service, ProductService $productService, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_service = $service;
        $this->_productService = $productService;
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
     * Lists all Promocode models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new PromocodeSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        return $this->render('@catalog/modules/promocode/views/promocode/index', [
            'searchModel'  => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Promocode model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('@catalog/modules/promocode/views/promocode/view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Promocode model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $promocodeForm = new PromocodeForm();
        $productList = $this->_productService->productList();

        if ($promocodeForm->load(Yii::$app->request->post()) && $promocodeForm->validate()) {
            try {
                $promocode = $this->_service->create($promocodeForm);
                return $this->redirect(['view', 'id' => $promocode->id]);
            } catch (\DomainException $e) {
                //@todo запись в лог
                throw new \DomainException('Can\t create product');
            }
        }

        return $this->render('@catalog/modules/promocode/views/promocode/create',
            compact('promocodeForm', 'productList'));
    }

    /**
     * Updates an existing Promocode model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $promocode = $this->_service->findById($id);
        $promocodeForm = new PromocodeForm($promocode);
        $productList = $this->_productService->productList();

        if ($promocodeForm->load(Yii::$app->request->post()) && $promocodeForm->validate()) {
            try {
                $this->_service->edit($id, $promocodeForm);
                return $this->redirect(['view', 'id' => $promocode->id]);
            } catch (\DomainException $e) {
                //@todo запись в лог
                throw new \DomainException('Can\t update product');
            }
        }

        return $this->render('@catalog/modules/promocode/views/promocode/update',
            compact('promocodeForm', 'productList'));
    }

    /**
     * Deletes an existing Promocode model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }

    /**
     * Finds the Promocode model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Promocode the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Promocode::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException(Yii::t('app', 'The requested page does not exist.'));
    }
}
