<?php
/* @var $this UsersController */

$this->setTitle('Регистрация');
?>

<div class="auth-form">

    <h3>Регистрация</h3>

    <?php
        /** @var CActiveForm $form */
        $form = $this->beginWidget('CActiveForm', array(
            'id'=>'register-form',
            'enableAjaxValidation'=>true,
            'enableClientValidation'=>true,
            'errorMessageCssClass'=>'text-danger',
            'clientOptions'=>array(
                'errorCssClass'=>'has-error'
            ),
            'focus'=>array($model,'name'),
        ));
    ?>

        <div class="form-group<?php if($model->hasErrors('name')): ?> has-error<?php endif; ?>">
            <?php echo $form->labelEx($model,'name', array('class'=>'control-label')); ?>
            <?php echo $form->textField($model,'name', array('class'=>'form-control')); ?>
            <span class="error-item"><?php echo $form->error($model,'name'); ?></span>
        </div>
        <div class="form-group<?php if($model->hasErrors('email')): ?> has-error<?php endif; ?>">
            <?php echo $form->labelEx($model,'email', array('class'=>'control-label')); ?>
            <?php echo $form->textField($model,'email', array('class'=>'form-control')); ?>
            <span class="error-item"><?php echo $form->error($model,'email'); ?></span>
        </div>
        <div class="row">
            <div class="form-group col-xs-6<?php if($model->hasErrors('password')): ?> has-error<?php endif; ?>">
                <?php echo $form->labelEx($model,'password', array('class'=>'control-label')); ?>
                <?php echo $form->passwordField($model,'password', array('class'=>'form-control')); ?>
                <span class="error-item"><?php echo $form->error($model,'password'); ?></span>
            </div>
            <div class="form-group col-xs-6<?php if($model->hasErrors('password2')): ?> has-error<?php endif; ?>">
                <?php echo $form->labelEx($model,'password2', array('class'=>'control-label')); ?>
                <?php echo $form->passwordField($model,'password2', array('class'=>'form-control')); ?>
                <span class="error-item"><?php echo $form->error($model,'password2'); ?></span>
            </div>
        </div>


        <div class="actions">
            <button type="submit" class="button button-green">Регистрация</button>
        </div>
    <?php $this->endWidget(); ?>

</div>