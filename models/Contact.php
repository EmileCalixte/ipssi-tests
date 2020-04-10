<?php


namespace app\models;


use borales\extensions\phoneInput\PhoneInputValidator;
use yii\validators\EmailValidator;

class Contact extends databaseModels\Contact
{
    public function rules()
    {
        return array_merge(parent::rules(),
        [
            [['email'], 'email'], /** Email field must be a valid email. {@see EmailValidator} */
            [['phone_number'], PhoneInputValidator::class], /** Phone number must be a valid phone number. {@see PhoneInputValidator} */
        ]);
    }
}