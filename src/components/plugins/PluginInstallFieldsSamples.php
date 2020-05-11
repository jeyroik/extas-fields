<?php
namespace extas\components\plugins;

use extas\components\fields\FieldSample;
use extas\interfaces\fields\IFieldSampleRepository;

/**
 * Class PluginInstallFieldsSamples
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallFieldsSamples extends PluginInstallDefault
{
    protected string $selfSection = 'fields_samples';
    protected string $selfName = 'field sample';
    protected string $selfRepositoryClass = IFieldSampleRepository::class;
    protected string $selfUID = FieldSample::FIELD__NAME;
    protected string $selfItemClass = FieldSample::class;
}
