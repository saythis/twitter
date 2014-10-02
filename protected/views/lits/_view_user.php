<?php
/* @var $this LitsController */
/* @var $data Lits */
?>

<div class="lit" id="lit<?php echo $data->id;?>">
    <div class="row">
        <div class="col-md-12">
            <span class="name"><?php echo CHtml::encode($data->user->name); ?></span>
            <span class="date"><?php echo CHtml::encode($data->created); ?></span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text">
            <p>
            <?php echo CHtml::encode($data->text); ?>

        </div>
    </div>

    <?php if($data->user_id==Yii::app()->user->id):?>
    <div>
        <ul class="list-inline">
            <li><?php echo CHtml::link('Изменить',array('lits/update','id'=>$data->id)); ?></li>
            <li><?php echo CHtml::ajaxLink(
                    'Удалить',
                    array('lits/delete','id'=>$data->id),
                    $ajaxOptions=array (
                        'type'=>'POST',
                        'dataType'=>'json',
                        'success'=>'function(){ jQuery("#lit'.$data->id.'").fadeOut(); }'
                    ),
                    $htmlOptions=array ()
                ); ?></li>
        </ul>
    </div>
    <?php endif; ?>
</div>