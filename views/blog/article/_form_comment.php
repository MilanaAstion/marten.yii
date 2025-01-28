<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Product $model */
/** @var yii\widgets\ActiveForm $form */
?>
<div class="blog-reply-wrapper mt-50">
    <h4 class="blog-dec-title">post a comment</h4>
    <form action="/blog/save-comment" method="POST">
        <?= Html::hiddenInput( Yii::$app->request->csrfParam, Yii::$app->request->csrfToken ) ?>
        <?= Html::hiddenInput( "article_id", $comment->article_id ) ?>
        <div class="row">
            <div class="col-md-6">
                <div class="leave-form">
                    <input type="text" placeholder="Full Name" name="author">
                </div>
            </div>
            <div class="col-md-6">
                <div class="leave-form">
                    <input type="email" placeholder="Eail Address " name="email">
                </div>
            </div>
            <div class="col-md-12">
                <div class="text-leave">
                    <textarea placeholder="Message" name="message"></textarea>
                    <input type="submit" value="SEND MESSAGE">
                </div>
            </div>
        </div>
    </form>
    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-6">
            <?= $form->field($comment, 'name')->textInput(['placeholder' => "Full Name"])->label(false) ?>
        </div>
        <div class="col-md-6">
            <?= $form->field($comment, 'email')->textInput(['placeholder' => "Email Address"])->label(false) ?>
        </div>
        <div class="col-md-12">
            <?= $form->field($comment, 'message')->textArea(['placeholder' => 'Message'])->label(false) ?>
        </div>
        <?= $form->field($comment, 'article_id')->hiddenInput()->label(false) ?>


        <div class="form-group">
            <?= Html::submitButton('SEND MESSAGE', ['class' => 'btn-submit']) ?>
        </div>
    </div>

    <?php ActiveForm::end(); ?>


</div>
