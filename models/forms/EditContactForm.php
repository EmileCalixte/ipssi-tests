<?php


use borales\extensions\phoneInput\PhoneInputValidator;
use yii\base\Model;

class EditContactForm extends Model
{
    private $email;
    private $firstname;
    private $lastname;
    private $phoneNumber;

    public function rules()
    {
        return [
            [['email', 'firstname', 'lastname'], 'required'],
            [['email'], 'string', 'max' => 255],
            [['email'], 'email'],
            [['firstname', 'lastname'], 'string', 'max' => 64],
            [['phone_number'], 'string', 'max' => 16],
            [['phone_number'], PhoneInputValidator::class],
        ];
    }
}