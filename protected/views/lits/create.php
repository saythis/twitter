<?php
/* @var $this LitsController */
/* @var $model Lits */

$this->breadcrumbs=array(
	'Lits'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Lits', 'url'=>array('index')),
	array('label'=>'Manage Lits', 'url'=>array('admin')),
);
?>

<h1>Create Lits</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>