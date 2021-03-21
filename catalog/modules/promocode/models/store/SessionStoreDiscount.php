<?php


namespace catalog\modules\promocode\models\store;

use catalog\models\product\Product;
use Yii;

/**
 * Class SessionStoreDiscount
 * @package catalog\modules\promocode\models\store
 */
class SessionStoreDiscount implements StoreInterface
{
    /**
     * @param string $promocodeName
     * @param array $idArray
     */
    public function applyDiscount(string $promocodeName, array $idArray): void
    {
        $session = Yii::$app->session;

        if ($session->has($promocodeName)) {
            $session->remove($promocodeName);
            $session[$promocodeName] = $idArray;
        } else {
            $session->set($promocodeName, $idArray);
        }
    }

    /**
     * @param string $promocodeName
     * @param $product
     */
    public function removeDiscount(string $promocodeName, Product $product): void
    {
        $session = Yii::$app->session;
        $idArray = $session->get($promocodeName);
        if (($key = array_search($product->id, $idArray)) !== false) {
            unset($idArray[$key]);
        }
        $session->remove($promocodeName);
        $session[$promocodeName] = $idArray;
    }
}