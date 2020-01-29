<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\modules\user\models\User */

/* @var $module dektrium\user\Module */

use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('user', 'Sign up');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to signup:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'registration-form',
                'enableAjaxValidation' => true,
            ]); ?>

            <?= $form->field($model, 'username')->textInput([
                'autofocus' => true,
            ]) ?>

            <?php if ($module->enableGeneratingPassword == false) { ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            <?php } ?>

            <?= Html::submitButton(Yii::t('user', 'Sign up'), ['class' => 'btn btn-success']) ?>

            <?php ActiveForm::end(); ?>

            <div style="margin-top: 15px; color:#999;">
                <p>
                    <?= Html::a(Yii::t('user', 'Already registered? Sign in!'), ['/user/security/login']) ?>
                </p>
            </div>
        </div>
        <div class="col-lg-7">
            <?= Connect::widget([
                'baseAuthUrl' => ['/user/security/auth'],
            ]) ?>
        </div>
    </div>


</div>
