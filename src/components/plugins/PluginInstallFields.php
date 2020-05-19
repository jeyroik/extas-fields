<?php
namespace extas\components\plugins;

use extas\components\fields\Field;
use extas\interfaces\fields\IFieldRepository;
use extas\interfaces\repositories\IRepository;
use Ramsey\Uuid\Uuid;
use Symfony\Component\Console\Output\OutputInterface;

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
    protected string $selfUID = Field::FIELD__ID;
    protected string $selfItemClass = Field::class;

    /**
     * @param string $uid
     * @param OutputInterface $output
     * @param array $item
     * @param IRepository $repo
     * @param string $method
     */
    public function install($uid, $output, $item, $repo, $method = 'create')
    {
        $uid = $uid ?: '@uuid6';
        $item[Field::FIELD__ID] = $uid;

        parent::install($uid, $output, $item, $repo, $method);
    }
}
