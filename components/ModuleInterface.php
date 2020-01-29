<?php

namespace app\components;

/**
 * Interface ModuleInterface
 * @package app\components
 */
interface ModuleInterface
{
    /**
     * @return string
     */
    public function getMigrationPath(): string;

    /**
     * @return array
     */
    public function getMenuItems(): array;
}