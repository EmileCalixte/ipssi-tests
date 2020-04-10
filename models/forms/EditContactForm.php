<?php

namespace app\models\forms;


use borales\extensions\phoneInput\PhoneInputValidator;
use yii\base\Model;

class EditContactForm extends Model
{
    public $email;
    public $firstname;
    public $lastname;
    public $phoneNumber;

    public function rules()
    {
        return [
            [['email', 'firstname', 'lastname'], 'required'],
            [['email'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['firstname', 'lastname'], 'string', 'max' => 64],
            [['phoneNumber'], 'string', 'max' => 16],
            [['phoneNumber'], PhoneInputValidator::class],
        ];
    }
}