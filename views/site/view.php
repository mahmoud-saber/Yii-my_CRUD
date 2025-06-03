<?php

use yii\helpers\Url;


/** @var yii\web\View $this */



$this->title = 'My Yii Application';
?>
<div class="site-index">
    <h1>View Posts</h1>
    <div class="body-content">
        <ul class="list-group">
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= $post->description ?>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= $post->title ?>
            </li>
            <li class="list-group-item d-flex justify-content-between align-items-center">
                <?= $post->categroy ?>
            </li>
        </ul>
        <div class="form-group">
            <a href="<?= Url::to(['site/home']) ?>" class="btn btn-danger">Back</a>
        </div>
    </div>
</div>