<?php
/* @var $this LitsController */
/* @var $data Lits */
?>

<div class="lit">
    <div class="row">

        <div class="col-md-12">
            <span class="name"><?php echo CHtml::link(CHtml::encode($data->user->name),array('lits/user','id'=>$data->user_id)); ?></span>
            <span class="date"><?php echo CHtml::encode($data->created); ?></span>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 text">
            <p>
            <?php echo CHtml::encode($data->text); ?>

        </div>
    </div>
</div>