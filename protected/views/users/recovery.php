<?php
/* @var $this UsersController */

$this->setTitle('Восстановление пароля');
?>

<div class="auth-form">

    <h3>Восстановление пароля</h3>

    <?php if(Yii::app()->user->hasFlash('success')){ ?>
        <div class="alert alert-success">
            <?php echo Yii::app()->user->getFlash('success'); ?>
        </div>
    <?php } else { ?>
        <div class="alert alert-info">
            На указанный Вами e-mail придет письмо с дальнейшими инструкциями по восстановлению пароля
        </div>
    <?php } ?>

    <?php
    /** @var CActiveForm $form */
    $form = $this->beginWidget('CActiveForm', array(
        'id'=>'recovery-form',
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

    <div class="actions">
        <button type="submit" class="button button-green">Восстановить</button>
    </div>
    <?php $this->endWidget(); ?>

    <div class="info">
        <a href="/register" class="button button-orange">Регистрация</a>
    </div>
</div>
