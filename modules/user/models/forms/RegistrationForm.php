<?php

namespace app\modules\user\models\forms;

use dektrium\user\models\RegistrationForm as BaseRegistrationForm;

/**
 * Class RegistrationForm
 * @package app\models\forms
 */
class RegistrationForm extends BaseRegistrationForm
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        $rules = parent::rules();

        unset($rules['emailRequired']);

        return $rules;
    }
}