<?php
/* @var $this UsersController */

$this->setTitle('Настройки');
?>

<h3>Настройки</h3>

<hr/>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div class="alert alert-success">
        <?php echo Yii::app()->user->getFlash('success'); ?>
        <?php Yii::app()->clientScript->registerScript('myHideEffect',
            '$(".alert").animate({opacity: 1.0}, 3000).slideUp("slow");', CClientScript::POS_READY);?>
    </div>
<?php endif; ?>


<?php /** @var CActiveForm $form */
$form = $this->beginWidget('CActiveForm', array(
    'id'=>'settings-form',
    'errorMessageCssClass'=>'text-danger',
    'htmlOptions'=>array(
        'class'=>'form-horizontal',
        'autocomplete'=>'off'
    )
)); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'name', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
            <?php echo $form->textField($model, 'name', array('class'=>'form-control')); ?>
            <?php echo $form->error($model, 'name'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'new_password', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
            <?php echo $form->passwordField($model, 'new_password', array('class'=>'form-control', 'placeholder'=>'*******')); ?>
            <?php echo $form->error($model, 'new_password'); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'new_password2', array('class'=>'col-sm-2 control-label')); ?>
        <div class="col-sm-4">
            <?php echo $form->passwordField($model, 'new_password2', array('class'=>'form-control', 'placeholder'=>'*******')); ?>
            <?php echo $form->error($model, 'new_password2'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-10">
            <button type="submit" class="btn btn-success">Сохранить</button>
        </div>
    </div>
<?php $this->endWidget(); ?>