<?php
/* @var $this LitsController */
/* @var $model Lits */

$this->breadcrumbs=array(
	'Lits'=>array('index'),
	$model->id=>array('view','id'=>$model->id),
	'Update',
);


?>

<h1>Изменение записи</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>