<?php

namespace app\models\databaseModels;

use Yii;

/**
 * This is the model class for table "contact".
 *
 * @property int $id
 * @property string $firstname
 * @property string $lastname
 * @property string|null $phone_number
 */
class Contact extends \app\components\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'contact';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['firstname', 'lastname'], 'required'],
            [['firstname', 'lastname'], 'string', 'max' => 64],
            [['phone_number'], 'string', 'max' => 16],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'firstname' => 'Firstname',
            'lastname' => 'Lastname',
            'phone_number' => 'Phone Number',
        ];
    }
}
