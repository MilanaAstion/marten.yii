<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use \yii\web\View;
use dosamigos\ckeditor\CKEditor;

/** @var yii\web\View $this */
/** @var app\models\Article $model */
/** @var yii\widgets\ActiveForm $form */

// $this->registerJsFile(Url::to('https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js'), ['depends' => [\yii\web\JqueryAsset::class]]);

// $this->registerJs("CKEDITOR.replace('article-content');", View::POS_END);
?>

<div class="article-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($articleImage, 'image')->fileInput() ?>

    <?= $form->field($model, 'author')->textInput(['maxlength' => true]) ?>

    <?//= $form->field($model, 'created')->textInput(['maxlength' => true]) ?>

    <!-- <?//= $form->field($model, 'content')->textarea(['rows' => 6]) ?> -->

    <?= $form->field($model, 'content')->widget(CKEditor::class, [
        'options' => ['rows' => 6],
        'preset' => 'full', // Можливі значення: 'basic', 'standard', 'full'
        'clientOptions' => [
            'filebrowserUploadUrl' => yii\helpers\Url::to(['article/image/upload']), // URL для загрузки
        ],
    ]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
<!-- <script src="https://cdn.ckeditor.com/4.20.0/standard/ckeditor.js"></script> -->

<!-- <script>
    CKEDITOR.replace('article-content');
</script> -->