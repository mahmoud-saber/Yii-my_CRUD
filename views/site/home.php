<?php


/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <?php if (Yii::$app->session->hasFlash('message')): ?>
        <div class="alert alert-success">
            <?= Yii::$app->session->getFlash('message') ?>
        </div>
    <?php endif; ?>

    <div class="jumbotron text-center bg-transparent mt-5 mb-5">
        <h1 class="display-4">Curd System</h1>

    </div>

    <div class="body-content">
        <div class="row">
            <span><?= Html::a('create', ['/site/create'], ['class' => 'btn btn-primary']) ?></span>
        </div>
        <div class="row">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Title</th>
                        <th scope="col">Description</th>
                        <th scope="col">Categroy</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (count($posts) > 0): ?>
                        <?php foreach ($posts as $post): ?>
                            <tr>
                                <td><?= Html::encode($post->id) ?></td>
                                <td><?= Html::encode($post->title) ?></td>
                                <td><?= Html::encode($post->description) ?></td>
                                <td><?= Html::encode($post->categroy) ?></td>
                                <td>
                                    <span>
                                        <?= Html::a('View', ['site/view', 'id' => $post->id], ['class' => 'btn btn-primary']) ?>
                                        <?= Html::a('Update', ['site/update', 'id' => $post->id], ['class' => 'btn btn-dark']) ?>
                                        <?= Html::a('Delete', ['site/delete', 'id' => $post->id], ['class' => 'btn btn-danger'], [
                                            'data' => [
                                                'confirm' => 'Are you sure you want to delete this item?',
                                                'method' => 'post',
                                            ]
                                        ]) ?>
                                    </span>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="5">No posts found.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>

    </div>
</div>