<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use app\models\Category;

/** @var yii\web\View $this */
/** @var app\models\Category $model */
/** @var yii\widgets\ActiveForm $form */
$categories = Category::find()->where(['parent_id' => Category::MAIN_PARENT_ID])->all();
$items = ArrayHelper::map($categories, 'id', 'name');
?>

<div class="category-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <!-- <?//= $form->field($model, 'img')->textInput(['maxlength' => true]) ?> -->

    <?= $form->field($model, 'parent_id')->dropDownList($items,
    [
        'class' => 'form-control',
        'prompt' => 'Выберите категорию',
    ]) ?>  

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
