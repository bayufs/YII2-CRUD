<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>View Post</h1>
    </div>

    <div class="body-content">
    <div class="row">
            <ul class="list-group">
                <li class="list-group-item d-flex justify-content-between align-items-center">
                    <?=  $post->title ?>
                    <span class="badge badge-primary badge-pill">14</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <?=  $post->description ?>
                    <span class="badge badge-primary badge-pill">2</span>
                </li>
                <li class="list-group-item d-flex justify-content-between align-items-center">
                <?=  $post->category ?>
                    <span class="badge badge-primary badge-pill">1</span>
                </li>
        </ul>
        <a href="<?php echo Yii::$app->homeUrl; ?>" class="btn btn-primary">Go Back</a>
    </div>
    </div>
</div>
