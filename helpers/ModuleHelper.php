<?php

namespace app\helpers;

use app\components\ModuleInterface;
use Yii;
use yii\helpers\ArrayHelper;

/**
 * Class ModuleHelper
 * @package app\helpers
 */
class ModuleHelper
{
    /**
     * @return array
     */
    public static function getMigrationPaths()
    {
        $migrationPaths = [];

        foreach (Yii::$app->modules as $key => $module) {
            $module = Yii::$app->getModule($key);

            if (
                $module instanceof ModuleInterface
                && is_string($module->getMigrationPath())
            ) {
                $migrationPaths[] = $module->getMigrationPath();
            }
        }

        return $migrationPaths;
    }

    /**
     * @return array
     */
    public static function getMenuItems()
    {
        $menuItems = [];

        foreach (Yii::$app->modules as $key => $module) {
            $module = Yii::$app->getModule($key);

            if (
                $module instanceof ModuleInterface
                && is_array($module->getMenuItems())
            ) {
                $menuItems = ArrayHelper::merge(
                    $menuItems,
                    $module->getMenuItems()
                );
            }
        }

        return $menuItems;
    }
}