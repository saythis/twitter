<?php
/* @var $this UsersController */

$this->setTitle('Восстановление пароля');
?>

<div class="auth-form">

    <h3>Восстановление пароля</h3>

    <?php
    /** @var CActiveForm $form */
    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'password-form',
        'enableAjaxValidation'=>true,
        'enableClientValidation'=>true,
        'errorMessageCssClass'=>'text-danger',
        'clientOptions'=>array('errorCssClass'=>'has-error'),
        'focus'=>array($model,'email'),
    ));
    ?>

    <div class="form-group<?php if($model->hasErrors('password')): ?> has-error<?php endif; ?>">
        <?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
        <span class="error-item"><?php echo $form->error($model,'password'); ?></span>
    </div>

    <div class="form-group<?php if($model->hasErrors('password2')): ?> has-error<?php endif; ?>">
        <?php echo $form->labelEx($model,'password2', array('class'=>'control-label')); ?>
        <?php echo $form->passwordField($model,'password2', array('class'=>'form-control')); ?>
        <span class="error-item"><?php echo $form->error($model,'password2'); ?></span>
    </div>

    <div class="actions">
        <button type="submit" class="button button-green">Восстановить</button>
    </div>
    <?php $this->endWidget(); ?>

    <div class="info">
        <a href="/register" class="button button-orange">Регистрация</a>
    </div>
</div>
