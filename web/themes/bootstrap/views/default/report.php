<?php
/* @var $this DefaultController */
/* @var $model SBReport */
/* @var $servers SBServer[] */
?>
<div class="row">
  <section class="span12">
<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'report-form',
	'enableAjaxValidation'=>true,
	'enableClientValidation'=>true,
	'clientOptions'=>array(
		'inputContainer'=>'.control-group',
		'validateOnSubmit'=>true,
	),
	'errorMessageCssClass'=>'help-inline',
	'htmlOptions'=>array(
		'class'=>'form-horizontal',
		'enctype'=>'multipart/form-data',
	),
)) ?>

      <div class="control-group">
        <?php echo $form->labelEx($model,'steam',array('class' => 'control-label')); ?>
        <div class="controls">
          <?php echo $form->textField($model,'steam'); ?>
          <?php echo $form->error($model,'steam'); ?>
        </div>
      </div>

      <div class="control-group">
        <?php echo $form->labelEx($model,'ip',array('class' => 'control-label')); ?>
        <div class="controls">
          <?php echo $form->textField($model,'ip'); ?>
          <?php echo $form->error($model,'ip'); ?>
        </div>
      </div>

      <div class="control-group">
        <?php echo $form->labelEx($model,'name',array('class' => 'control-label')); ?>
        <div class="controls">
          <?php echo $form->textField($model,'name'); ?>
          <?php echo $form->error($model,'name'); ?>
        </div>
      </div>

      <div class="control-group">
        <?php echo $form->labelEx($model,'reason',array('class' => 'control-label')); ?>
        <div class="controls">
          <?php echo $form->textArea($model,'reason'); ?>
          <?php echo $form->error($model,'reason'); ?>
        </div>
      </div>

      <div class="control-group">
        <?php echo $form->labelEx($model,'user_name',array('class' => 'control-label')); ?>
        <div class="controls">
          <?php echo $form->textField($model,'user_name'); ?>
          <?php echo $form->error($model,'user_name'); ?>
        </div>
      </div>

      <div class="control-group">
        <?php echo $form->labelEx($model,'user_email',array('class' => 'control-label')); ?>
        <div class="controls">
          <?php echo $form->textField($model,'user_email'); ?>
          <?php echo $form->error($model,'user_email'); ?>
        </div>
      </div>

      <div class="control-group">
        <?php echo $form->labelEx($model,'server_id',array('class' => 'control-label')); ?>
        <div class="controls">
          <select class="span6" id="SBReport_server_id" name="SBReport[server_id]">
            <option value="">- <?php echo Yii::t('sourcebans', 'Unknown') ?> -</option>
<?php foreach($games as $game): ?>
            <optgroup label="<?php echo CHtml::encode($game->name) ?>">
<?php foreach($game->servers as $server): ?>
              <option value="<?php echo $server->id ?>"><?php echo Yii::t('sourcebans', 'components.ServerQuery.loading') . ' (' . $server . ')' ?></option>
<?php endforeach ?>
            </optgroup>
<?php endforeach ?>
            </select>
          <?php echo $form->error($model,'server_id',null,true,false); ?>
        </div>
      </div>

      <div class="control-group">
        <?php echo CHtml::label($model->getAttributeLabel('demo.filename'),'SBDemo_filename',array('class' => 'control-label')); ?>
        <div class="controls">
          <div class="fileupload fileupload-new" data-provides="fileupload">
            <div class="input-append">
              <div class="uneditable-input span3"><i class="icon-file fileupload-exists"></i> <span class="fileupload-preview"></span></div>
              <span class="btn btn-file">
                <span class="fileupload-new"><?php echo Yii::t('sourcebans', 'Select') ?></span>
                <span class="fileupload-exists"><?php echo Yii::t('sourcebans', 'Change') ?></span>
                <?php echo $form->fileField($model->demo,'filename') ?>
              </span>
              <a href="#" class="btn fileupload-exists" data-dismiss="fileupload"><?php echo Yii::t('sourcebans', 'Remove') ?></a>
            </div>
          </div>
          <?php echo $form->error($model->demo,'filename',null,true,false); ?>
        </div>
      </div>

      <div class="control-group buttons">
        <div class="controls">
          <?php echo CHtml::submitButton(Yii::t('sourcebans', 'Submit'),array('class' => 'btn')); ?>
        </div>
      </div>

<?php $this->endWidget() ?>
  </section>
</div>

<?php Yii::app()->clientScript->registerScript('default_report_queryServers', '
  $.getJSON("' . $this->createUrl('servers/info') . '", function(servers) {
    $.each(servers, function(i, server) {
      var $option = $("#SBReport_server_id option[value=\"" + server.id + "\"]");
      $option.text(server.error ? server.error.message : server.hostname);
    });
  });
') ?>