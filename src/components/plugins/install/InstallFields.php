<?php
namespace extas\components\plugins\install;

use extas\components\fields\Field;
use extas\interfaces\IItem;
use extas\interfaces\packages\IInstaller;

/**
 * Class PluginInstallFields
 *
 * @package extas\components\plugins\install
 * @author jeyroik@gmail.com
 */
class InstallFields extends InstallSection
{
    protected string $selfSection = 'fields';
    protected string $selfName = 'field';
    protected string $selfRepositoryClass = 'fieldRepository';
    protected string $selfUID = Field::FIELD__ID;
    protected string $selfItemClass = Field::class;

    /**
     * @param string $sectionName
     * @param array $item
     * @param IItem|null $existed
     * @param IInstaller $installer
     */
    protected function installItem(string $sectionName, array $item, ?IItem $existed, IInstaller &$installer): void
    {
        $uid = $item[Field::FIELD__ID] ?? '@uuid6';
        $item[Field::FIELD__ID] = $uid;

        parent::installItem($sectionName, $item, $existed, $installer);
    }
}
