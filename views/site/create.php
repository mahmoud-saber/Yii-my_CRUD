<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\widgets\ActiveForm;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <h1>Create Posts</h1>
    <div class="body-content">
        <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="form-group">
                <div class="col-lg-6">
                    <?= $form->field($post, 'title') ?>
                    <?= $form->field($post, 'description') ?>
                    <?= $form->field($post, 'categroy')->dropDownList([
                        'news' => 'News',
                        'blog' => 'Blog',
                        'tutorial' => 'Tutorial'
                    ], ['prompt' => 'Select']) ?>
                </div>
            </div>
        </div>
        <div class="form-group">
            <?= Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>
            <a href="<?= \yii\helpers\Url::to(['site/home']) ?>" class="btn btn-danger">Back</a>
        </div>
        <?php ActiveForm::end(); ?>
    </div>
</div>