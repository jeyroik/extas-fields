<?php
namespace tests;

use extas\components\console\TSnuffConsole;
use extas\components\extensions\ExtensionRepository;
use extas\components\fields\Field;
use extas\components\fields\FieldRepository;
use extas\components\fields\types\FieldType;
use extas\components\fields\types\FieldTypeRepository;
use extas\components\packages\Installer;
use extas\components\plugins\install\InstallFields;
use extas\components\plugins\Plugin;
use extas\components\plugins\PluginRepository;
use extas\components\plugins\repositories\PluginFieldUuid;
use extas\components\repositories\TSnuffRepository;
use extas\interfaces\fields\IField;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;

/**
 * Class FieldTest
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class FieldTest extends TestCase
{
    use TSnuffConsole;
    use TSnuffRepository;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->registerSnuffRepos([
            'fieldTypeRepository' => FieldTypeRepository::class,
            'fieldRepository' => FieldRepository::class,
            'pluginRepository' => PluginRepository::class,
            'extensionRepository' => ExtensionRepository::class
        ]);
    }

    protected function tearDown(): void
    {
        $this->unregisterSnuffRepos();
    }

    public function testBasicMethods()
    {
        $this->createWithSnuffRepo('fieldTypeRepository', new FieldType([
            FieldType::FIELD__NAME => 'string',
            FieldType::FIELD__TITLE => 'String type'
        ]));

        $field = new Field([Field::FIELD__TYPE => 'string']);
        $type = $field->getTypeObject();

        $this->assertNotEmpty($type);
        $this->assertEquals('String type', $type->getTitle());
    }

    public function testPluginInstallField()
    {
        $this->createWithSnuffRepo('pluginRepository', new Plugin([
            Plugin::FIELD__CLASS => PluginFieldUuid::class,
            Plugin::FIELD__STAGE => 'extas.fields.create.before'
        ]));
        $plugin = new class ([
            InstallFields::FIELD__INPUT => $this->getInput(),
            InstallFields::FIELD__OUTPUT => $this->getOutput()
        ]) extends InstallFields {
            protected function installPackageEntity(array $item): void
            {

            }
        };
        $sectionData = [[Field::FIELD__NAME => 'test']];
        $installer = new Installer();
        $plugin('fields', $sectionData, $installer);
        /**
         * @var IField $field
         */
        $field = $this->fieldRepo->one([Field::FIELD__NAME => 'test']);
        $this->assertNotEmpty($field, 'Field is not installed');
        $this->assertNotEmpty($field->getId(), 'ID is not uuid, if it is empty');
    }
}
