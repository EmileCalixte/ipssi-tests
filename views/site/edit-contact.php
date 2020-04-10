<?php

/** @var \app\models\forms\EditContactForm $model */
/** @var \app\models\Contact|null $contact */

/* @var $this yii\web\View */

use borales\extensions\phoneInput\PhoneInput; ?>

<?php

$form = \yii\widgets\ActiveForm::begin([
    'id' => 'contact-form',
]);

?>

<?= $form->field($model, 'email') ?>

<?= $form->field($model, 'firstname') ?>

<?= $form->field($model, 'lastname') ?>

<?= $form->field($model, 'phoneNumber')->widget(PhoneInput::class, [
    'jsOptions' => [
        'preferredCountries' => ['fr', 'us'],
    ],
]) ?>

<?= \yii\helpers\Html::submitButton('Save', ['class' => 'btn btn-primary']) ?>

<?php \yii\widgets\ActiveForm::end(); ?>

<?php
if($this->context->action->id === 'edit-contact') {
    $form = \yii\widgets\ActiveForm::begin([
        'id' => 'delete-form',
        'action' => '/site/delete-contact',
    ]);
    ?>

    <?= \yii\helpers\Html::hiddenInput('contactId', $contact->id) ?>

    <?= \yii\helpers\Html::submitButton('Delete', ['class' => 'btn btn-danger']) ?>

    <?php
    \yii\widgets\ActiveForm::end();
}
