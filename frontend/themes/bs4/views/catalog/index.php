<?php
/** @var $this \yii\web\View
 * @var $dataProvider \yii\data\ActiveDataProvider
 */
?>

<?php
foreach ($dataProvider->getModels() as $model) {
    echo $this->render('_card', [
        'model' => $model,
    ]);
}
?>
