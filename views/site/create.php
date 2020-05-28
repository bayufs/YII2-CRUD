<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Create Post</h1>
    </div>

    <div class="body-content">
    <div class="row">
    <?php if(Yii::$app->session->hasFlash('success'))  { ?>
    <div class="alert alert-success"><?=  Yii::$app->session->getFlash('success') ?></div>
    <?php  } elseif(Yii::$app->session->hasFlash('failed'))  { ?>
        <div class="alert alert-danger"><?=  Yii::$app->session->getFlash('failed') ?></div>
    <?php } ?>
    <?php $form = ActiveForm::begin() ?>
        <div class="form-group">
            <?php echo $form->field($post, 'title')  ?>
        </div>
        <div class="form-group">
            <?php echo $form->field($post, 'description')->textarea(['rows' => 6]); ?>
        </div>
        <div class="form-check">
        <?php $items = ['e-comerce' => 'e-comerce', 'cms' => 'cms', 'framework' => 'framework'] ?>
        <?php echo $form->field($post, 'category')->dropDownList($items, ['prompt' => 'select'])  ?>
        </div>
        <?= Html::submitButton('Submit', ['class' => 'btn btn-primary']) ?> | <a href="<?php echo Yii::$app->homeUrl; ?>" class="btn btn-primary">Go Back</a>
        <?php ActiveForm::end() ?>
    </div>
    </div>
</div>
