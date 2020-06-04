<?php
namespace extas\components\plugins\uninstall;

use extas\components\fields\FieldSample;

/**
 * Class UninstallFieldsSamples
 *
 * @package extas\components\plugins\uninstall
 * @author jeyroik <jeyroik@gmail.com>
 */
class UninstallFieldsSamples extends UninstallSection
{
    protected string $selfSection = 'fields_samples';
    protected string $selfName = 'field sample';
    protected string $selfRepositoryClass = 'fieldSampleRepository';
    protected string $selfUID = FieldSample::FIELD__NAME;
    protected string $selfItemClass = FieldSample::class;
}
