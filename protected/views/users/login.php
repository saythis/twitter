<?php
/* @var $this UsersController */

$this->setTitle('Авторизация');
?>

<div class="auth-form">

    <h3>Авторизация</h3>
    <?php
    /** @var CActiveForm $form */
    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'login-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'errorMessageCssClass'=>'text-danger',
        'clientOptions'=>array(
            'errorCssClass'=>'has-error'
        ),
        'focus'=>array($model,'email'),
    ));
    ?>

    <div class="form-group<?php if($model->hasErrors('email')): ?> has-error<?php endif; ?>">
        <?php echo $form->labelEx($model,'email', array('class'=>'control-label')); ?>
        <?php echo $form->textField($model,'email', array('class'=>'form-control')); ?>
        <span class="error-item"><?php echo $form->error($model,'email'); ?></span>
    </div>
    <div class="form-group<?php if($model->hasErrors('password')): ?> has-error<?php endif; ?>">
        <?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
        <span class="error-item"><?php echo $form->error($model,'password'); ?></span>
    </div>
    <div class="checkbox">
        <?php echo $form->checkBox($model, 'rememberMe'); ?>
        <label>
            <?php echo $form->checkBox($model, 'rememberMe'); ?>
            запомнить меня
        </label>
    </div>

    <div class="actions">
        <button type="submit" class="button button-green">Войти</button>
    </div>
    <?php $this->endWidget(); ?>

    <div class="info">
        <p>Есть уже аккаунт, но забыли пароль?</p>

        <a href="/recovery" class="button button-orange">Восстановить</a>
    </div>
</div>
