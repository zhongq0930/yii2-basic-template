<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model dektrium\user\models\LoginForm */

/* @var $module dektrium\user\Module */

use dektrium\user\models\LoginForm;
use dektrium\user\widgets\Connect;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = Yii::t('user', 'Sign in');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-security-login">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out the following fields to login:</p>

    <div class="row">
        <div class="col-lg-5">
            <?php $form = ActiveForm::begin([
                'id' => 'login-form',
                'enableAjaxValidation' => true,
            ]); ?>

            <?php if ($module->debug) { ?>
                <?= $form->field($model, 'login')->dropDownList(LoginForm::loginList()) ?>
            <?php } else { ?>
                <?= $form->field($model, 'login')->textInput([
                    'autofocus' => true,
                ]) ?>
            <?php } ?>

            <?php if ($module->debug) { ?>
                <div class="alert alert-warning">
                    <?= Yii::t('user', 'Password is not necessary because the module is in DEBUG mode.'); ?>
                </div>
            <?php } else { ?>
                <?= $form->field($model, 'password')->passwordInput() ?>
            <?php } ?>

            <?= $form->field($model, 'rememberMe')->checkbox([
                'checked' => 'checked',
            ]) ?>

            <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>

            <?php ActiveForm::end(); ?>

            <div style="margin-top: 15px; color:#999;">
                <?php if ($module->enableConfirmation) { ?>
                    <p>
                        <?= Html::a(Yii::t('user', 'Didn\'t receive confirmation message?'), ['/user/registration/resend']) ?>
                    </p>
                <?php } ?>
                <?php if ($module->enableRegistration) { ?>
                    <p>
                        <?= Html::a(Yii::t('user', 'Don\'t have an account? Sign up!'), ['/user/registration/register']) ?>
                    </p>
                <?php } ?>
            </div>
        </div>
        <div class="col-lg-7">
            <?= Connect::widget([
                'baseAuthUrl' => ['/user/security/auth'],
            ]) ?>
        </div>
    </div>
</div>
