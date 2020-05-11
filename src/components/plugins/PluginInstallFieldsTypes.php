<?php
namespace extas\components\plugins;

use extas\components\fields\types\FieldType;
use extas\interfaces\fields\types\IFieldTypeRepository;

/**
 * Class PluginInstallFieldsTypes
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallFieldsTypes extends PluginInstallDefault
{
    protected string $selfSection = 'fields_types';
    protected string $selfName = 'field type';
    protected string $selfRepositoryClass = IFieldTypeRepository::class;
    protected string $selfUID = FieldType::FIELD__NAME;
    protected string $selfItemClass = FieldType::class;
}
