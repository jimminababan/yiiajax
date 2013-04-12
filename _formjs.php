<?php $form=$this->beginWidget('CActiveForm', array(
  'id'=>'file-type-form',
	'enableAjaxValidation'=>false,
)); ?>


<div class="form">
	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'filetype_name'); ?>
		<?php echo $form->textField($model,'filetype_name',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'filetype_name'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'filetype_desc'); ?>
		<?php echo $form->textArea($model,'filetype_desc',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'filetype_desc'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>


</div>
