<?php


namespace frontend\controllers;


use catalog\models\product\ProductService;
use catalog\models\product\PromocodeForm;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;
use yii\web\Response;

/**
 * Class CatalogController
 * @package frontend\controllers
 */
class CatalogController extends Controller
{
    /** @var ProductService $_service */
    private $_service;

    /**
     * CatalogController constructor.
     * @param $id
     * @param $module
     * @param ProductService $service
     * @param array $config
     */
    public function __construct($id, $module, ProductService $service, $config = [])
    {
        parent::__construct($id, $module, $config);
        $this->_service = $service;
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $products = $this->_service->findAll();
        $promocodeForm = new PromocodeForm();

        return $this->render('index', [
            'products'  => $products,
            'promocodeForm' => $promocodeForm,
        ]);
    }

    /**
     * @return bool|Response
     */
    public function actionApplyPromocode()
    {
        $promocodeForm = new PromocodeForm();
        if ($promocodeForm->load(Yii::$app->request->post()) && $promocodeForm->validate()) {
            $this->_service->applyPromocode(Yii::$app->request->post('PromocodeForm')['name']);
            return $this->redirect('index');
        }
        return false;
    }

    /**
     * @return array|bool
     */
    public function actionIndexJson()
    {
        if (Yii::$app->request->isAjax) {
            Yii::$app->response->format = Response::FORMAT_JSON;
            return Yii::$app->response->data = $this->_service->jsonData();
        }
        return false;
    }

    /**
     * @param int $id
     * @return Response
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionRemoveDiscount(int $id)
    {
        $this->_service->removeDiscount($id);
        return $this->redirect('index');
    }
}