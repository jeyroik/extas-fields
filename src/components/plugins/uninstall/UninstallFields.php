<?php
namespace extas\components\plugins\uninstall;

use extas\components\fields\Field;

/**
 * Class UninstallFields
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik <jeyroik@gmail.com>
 */
class UninstallFields extends UninstallSection
{
    protected string $selfSection = 'fields';
    protected string $selfName = 'field';
    protected string $selfRepositoryClass = 'fieldRepository';
    protected string $selfUID = Field::FIELD__ID;
    protected string $selfItemClass = Field::class;
}
