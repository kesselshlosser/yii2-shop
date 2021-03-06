<?
/** @var ozerich\shop\models\Product $model */
/** @var ozerich\shop\modules\admin\forms\ProductMediaForm $formModel */
?>

<?php $form = \yii\widgets\ActiveForm::begin([
    'action' => '/admin/products/media/' . $model->id,
    'enableClientValidation' => false,
]); ?>

<div class="row">
  <div class="col-xs-12">
      <?= $form->field($formModel, 'images')->widget(ozerich\shop\modules\admin\widgets\ImageWidget::class, [
          'scenario' => 'product',
          'multiple' => true
      ]) ?>
  </div>

  <div class="col-xs-12">
      <?= $form->field($formModel, 'video')->textInput(); ?>
  </div>
</div>

<?= $this->render('_box_footer'); ?>

<?php
\yii\widgets\ActiveForm::end();
?>
