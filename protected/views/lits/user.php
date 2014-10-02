<?php
/* @var $this LitsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lits',
);


?>

<h1><?php echo $user->name; ?></h1>
<h5 class="grey">записи пользователя</h5>

<?php if($user->id==Yii::app()->user->id): ?>
<?php $this->renderPartial('_form', array('model'=>$model)); ?>
<?php endif; ?>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
    'summaryText'=>'',
    'itemView'=>'_view_user',
)); ?>
