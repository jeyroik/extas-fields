<?php
namespace extas\components\plugins\uninstall;

use extas\components\fields\types\FieldType;

/**
 * Class UninstallFieldsTypes
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik <jeyroik@gmail.com>
 */
class UninstallFieldsTypes extends UninstallSection
{
    protected string $selfSection = 'fields_types';
    protected string $selfName = 'field type';
    protected string $selfRepositoryClass = 'fieldTypeRepository';
    protected string $selfUID = FieldType::FIELD__NAME;
    protected string $selfItemClass = FieldType::class;
}
