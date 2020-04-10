<?php


namespace app\components;


use app\models\exceptions\MyCustomException;
use yii\db\BaseActiveRecord;

class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * Extends {@see BaseActiveRecord::__set} to validate new value when set
     * @param string $name
     * @param mixed $value
     * @throws MyCustomException if attribute value does not match rules
     */
    public function __set($name, $value)
    {
        $oldValue = $this->$name;

        parent::__set($name, $value);

        if(!$this->validate($name)) {
            parent::__set($name, $oldValue);

            throw new MyCustomException(implode(' - ', $this->errors[$name]));
        }
    }
}