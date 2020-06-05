<?php
namespace extas\components\plugins\install;

use extas\components\fields\types\FieldTypeSample;
use extas\interfaces\fields\types\IFieldTypeSampleRepository;

/**
 * Class InstallFieldsTypesSamples
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallFieldsTypesSamples extends InstallSection
{
    protected string $selfSection = 'fields_types_samples';
    protected string $selfName = 'field type sample';
    protected string $selfRepositoryClass = 'fieldTypeSampleRepository';
    protected string $selfUID = FieldTypeSample::FIELD__NAME;
    protected string $selfItemClass = FieldTypeSample::class;
}
