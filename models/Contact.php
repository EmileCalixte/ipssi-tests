<?php


namespace app\models;


use yii\validators\EmailValidator;

class Contact extends databaseModels\Contact
{
    public function rules()
    {
        return array_merge(parent::rules(),
        [
           [['email'], 'email'], /** Email field must be a valid email. {@see EmailValidator} */
        ]);
    }
}