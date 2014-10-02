<?php
/* @var $this LitsController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Lits',
);


?>

<h1>Записи пользователей</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
    'summaryText'=>'',
    'itemView'=>'_view',
)); ?>
