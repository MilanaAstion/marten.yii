<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\productImage $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="product-image-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'prod_id')->hiddenInput(['value' => $prod_id])->label(false) ?>

    <?= $form->field($img, 'imageFile')->fileInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
