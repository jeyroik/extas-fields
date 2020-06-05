<?php
namespace extas\components\plugins\install;

use extas\components\fields\FieldSample;
use extas\interfaces\fields\IFieldSampleRepository;

/**
 * Class InstallFieldsSamples
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallFieldsSamples extends InstallSection
{
    protected string $selfSection = 'fields_samples';
    protected string $selfName = 'field sample';
    protected string $selfRepositoryClass = 'fieldSampleRepository';
    protected string $selfUID = FieldSample::FIELD__NAME;
    protected string $selfItemClass = FieldSample::class;
}
