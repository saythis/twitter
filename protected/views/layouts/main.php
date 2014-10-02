<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta name="language" content="en" />

    <?php Yii::app()->clientScript->registerCoreScript('jquery');  ?>

    <?php Yii::app()->clientScript->registerCssFile('/css/bootstrap.min.css');  ?>
    <?php Yii::app()->clientScript->registerCssFile('/css/bootstrap-theme.css');  ?>
    <?php Yii::app()->clientScript->registerCssFile('/css/style.css');  ?>

    <?php Yii::app()->clientScript->registerScriptFile('/js/bootstrap.min.js');  ?>
    <?php Yii::app()->clientScript->registerScriptFile('/js/app.js');  ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>

<body>
<!-- Fixed navbar -->
<div class="navbar navbar-default navbar-fixed-top" role="navigation">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">Litter</a>
        </div>
        <div class="collapse navbar-collapse">
            <?php $this->widget('zii.widgets.CMenu',array(
                'items'=>array(
                    array('label'=>'Главная', 'url'=>array('/lits/index')),
                    array('label'=>'Мои записи', 'url'=>array('/lits/user'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Мои настройки', 'url'=>array('/users/settings'), 'visible'=>!Yii::app()->user->isGuest),
                    array('label'=>'Вход', 'url'=>array('/users/login'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Регистрация', 'url'=>array('/users/register'), 'visible'=>Yii::app()->user->isGuest),
                    array('label'=>'Выход', 'url'=>array('/site/logout'), 'visible'=>!Yii::app()->user->isGuest)
                ),
                'htmlOptions'=>array('class'=>'nav navbar-nav'),
            )); ?>
        </div><!--/.nav-collapse -->
    </div>
</div>


<div class="container">
    <?php if(isset($this->breadcrumbs)):?>
        <?php $this->widget('zii.widgets.CBreadcrumbs', array(
			'links'=>$this->breadcrumbs,
		)); ?><!-- breadcrumbs -->
    <?php endif?>

    <?php echo $content; ?>
</div>

<div class="footer">
    <div class="container">
        <p>Copyright &copy; <?php echo date('Y'); ?> by My Company.<br/>
            All Rights Reserved.<br/></p>
        <ul class="muted list-inline">
        </ul>
    </div>
</div>


</body>
</html>
