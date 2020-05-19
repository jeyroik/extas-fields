<?php
namespace tests;

use extas\components\extensions\TSnuffExtensions;
use extas\components\fields\Field;
use extas\components\fields\FieldRepository;
use extas\components\fields\types\FieldType;
use extas\components\fields\types\FieldTypeRepository;
use extas\components\plugins\Plugin;
use extas\components\plugins\PluginInstallFields;
use extas\components\plugins\PluginRepository;
use extas\components\plugins\repositories\PluginFieldUuid;
use extas\interfaces\fields\IField;
use extas\interfaces\repositories\IRepository;
use PHPUnit\Framework\TestCase;
use Dotenv\Dotenv;
use Symfony\Component\Console\Output\NullOutput;

/**
 * Class FieldTest
 *
 * @package tests
 * @author jeyroik@gmail.com
 */
class FieldTest extends TestCase
{
    use TSnuffExtensions;

    protected IRepository $typeRepo;
    protected IRepository $fieldRepo;
    protected IRepository $pluginRepo;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->typeRepo = new FieldTypeRepository();
        $this->fieldRepo = new FieldRepository();
        $this->pluginRepo = new PluginRepository();
        $this->addReposForExt([
            'fieldTypeRepository' => FieldTypeRepository::class,
            'fieldRepository' => FieldRepository::class
        ]);
        $this->createRepoExt(['fieldRepository', 'fieldTypeRepository']);
    }

    protected function tearDown(): void
    {
        $this->deleteSnuffExtensions();
        $this->typeRepo->delete([FieldType::FIELD__NAME => 'string']);
        $this->fieldRepo->delete([Field::FIELD__NAME => 'test']);
        $this->pluginRepo->delete([Plugin::FIELD__CLASS => PluginFieldUuid::class]);
    }

    public function testBasicMethods()
    {
        $this->typeRepo->create(new FieldType([
            FieldType::FIELD__NAME => 'string',
            FieldType::FIELD__TITLE => 'String type'
        ]));
        $this->createRepoExt(['fieldTypeRepository']);
        $field = new Field([Field::FIELD__TYPE => 'string']);
        $type = $field->getTypeObject();

        $this->assertNotEmpty($type);
        $this->assertEquals('String type', $type->getTitle());
    }

    public function testPluginInstallField()
    {
        $this->pluginRepo->create(new Plugin([
            Plugin::FIELD__CLASS => PluginFieldUuid::class,
            Plugin::FIELD__STAGE => 'extas.fields.create.before'
        ]));
        $plugin = new PluginInstallFields();
        $plugin->install('', new NullOutput(), ['name' => 'test'], new FieldRepository());
        /**
         * @var IField $field
         */
        $field = $this->fieldRepo->one([Field::FIELD__NAME => 'test']);
        $this->assertNotEmpty($field, 'Field is not installed');
        $this->assertNotEmpty($field->getId(), 'ID is not uuid, if it is empty');
    }
}
