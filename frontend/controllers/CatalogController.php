<?php


namespace frontend\controllers;


use catalog\models\product\ProductService;
use Yii;
use yii\helpers\Json;
use yii\web\Controller;

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
        $dataProvider = $this->_service->findAll();

        return $this->render('index', [
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * @return false|string
     */
    public function actionIndexJson()
    {
        if (Yii::$app->request->isAjax) {
            $dataProvider = $this->_service->findAll();
            return Yii::$app->response->data = Json::encode(['dataProvider' => $dataProvider]);
        }
        return false;
    }
}