<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\productImage $model */

$this->title = 'Create Product Image';
$this->params['breadcrumbs'][] = ['label' => 'Product Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-image-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'prod_id' => $prod_id,
    ]) ?>

</div>
