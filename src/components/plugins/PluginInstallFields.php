<?php
namespace extas\components\plugins;

use extas\components\fields\Field;
use extas\interfaces\fields\IFieldRepository;

/**
 * Class PluginInstallFields
 *
 * @package extas\components\plugins
 * @author jeyroik@gmail.com
 */
class PluginInstallFields extends PluginInstallDefault
{
    protected string $selfSection = 'fields';
    protected string $selfName = 'field';
    protected string $selfRepositoryClass = IFieldRepository::class;
    protected string $selfUID = Field::FIELD__NAME;
    protected string $selfItemClass = Field::class;
}
