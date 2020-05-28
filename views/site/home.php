<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>YII2 CRUD Tutorial</h1>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-12">
            <?= Html::a('Create', ['create'], $options = ['class' => 'btn btn-primary']) ?>
            <table class="table">
            <thead class="thead-dark">
                <tr>
                <th scope="col">ID</th>
                <th scope="col">Title</th>
                <th scope="col">Description</th>
                <th scope="col">Category</th>
                <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php if(count($posts) > 0) { ?>
               <?php foreach($posts as $post) { ?>
                <tr>
                    <td><?= $post->id ?></td>
                    <td><?= $post->title ?></td>
                    <td><?= $post->description ?></td>
                    <td><?= $post->category ?></td>
                    <td>
                        <label for=""><?= Html::a('View', ['view', 'id' => $post->id], $options = ['class' => 'label label-primary']) ?></label>
                        <label for=""><?= Html::a('Update', ['update', 'id' => $post->id] , $options = ['class' => 'label label-warning']) ?></label>
                        <label for=""><?= Html::a('Delete', ['delete', 'id' => $post->id], $options = ['class' => 'label label-danger']) ?></label>
                    </td>
                </tr>
               <?php } ?>
            <?php } else  { ?>
            <h4>No record found</h4>
            <?php } ?>
            
            </tbody>
            </table>   
            </div>
        </div>
    </div>
</div>
