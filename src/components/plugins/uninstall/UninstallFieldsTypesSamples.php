<?php
namespace extas\components\plugins\uninstall;

use extas\components\fields\types\FieldTypeSample;

/**
 * Class UninstallFieldsTypesSamples
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik <jeyroik@gmail.com>
 */
class UninstallFieldsTypesSamples extends UninstallSection
{
    protected string $selfSection = 'fields_types_samples';
    protected string $selfName = 'field type sample';
    protected string $selfRepositoryClass = 'fieldTypeSampleRepository';
    protected string $selfUID = FieldTypeSample::FIELD__NAME;
    protected string $selfItemClass = FieldTypeSample::class;
}
