<?php
/* @var $this LitsController */
/* @var $model Lits */

$this->breadcrumbs=array(
	'Lits'=>array('index'),
	$model->id,
);

?>

<h1>View Lits #<?php echo $model->id; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'id',
		'user_id',
		'text',
		'created',
	),
)); ?>
