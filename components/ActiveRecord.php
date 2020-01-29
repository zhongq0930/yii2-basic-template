<?php

namespace app\components;

/**
 * Class ActiveRecord
 * @package app\components
 */
class ActiveRecord extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     * @return ActiveQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ActiveQuery(get_called_class());
    }

    /**
     * Formats all model errors into a single string
     * @return string
     */
    protected function formatErrors()
    {
        $result = '';

        foreach ($this->getErrors() as $attribute => $errors) {
            $result .= implode(" ", $errors) . " ";
        }

        return $result;
    }
}