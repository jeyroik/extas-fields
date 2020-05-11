<?php
namespace extas\components\plugins;

use extas\components\fields\types\FieldTypeSample;
use extas\interfaces\fields\types\IFieldTypeSampleRepository;

/**
 * Class PluginInstallFieldsTypesSamples
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallFieldsTypesSamples extends PluginInstallDefault
{
    protected string $selfSection = 'fields_types_samples';
    protected string $selfName = 'field type sample';
    protected string $selfRepositoryClass = IFieldTypeSampleRepository::class;
    protected string $selfUID = FieldTypeSample::FIELD__NAME;
    protected string $selfItemClass = FieldTypeSample::class;
}
