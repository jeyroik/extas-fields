<?php
namespace extas\components\plugins\install;

use extas\components\fields\types\FieldType;
use extas\interfaces\fields\types\IFieldTypeRepository;

/**
 * Class InstallFieldsTypes
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallFieldsTypes extends InstallSection
{
    protected string $selfSection = 'fields_types';
    protected string $selfName = 'field type';
    protected string $selfRepositoryClass = IFieldTypeRepository::class;
    protected string $selfUID = FieldType::FIELD__NAME;
    protected string $selfItemClass = FieldType::class;
}
