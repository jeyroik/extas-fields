<?php
namespace tests;

use extas\components\console\TSnuffConsole;
use extas\components\extensions\ExtensionRepository;
use extas\components\fields\Field;
use extas\components\fields\FieldRepository;
use extas\components\fields\THasFields;
use extas\components\fields\types\FieldType;
use extas\components\fields\types\FieldTypeRepository;
use extas\components\Item;
use extas\components\packages\entities\EntityRepository;
use extas\components\packages\Installer;
use extas\components\plugins\install\InstallFields;
use extas\components\plugins\install\InstallItem;
use extas\components\plugins\PluginRepository;
use extas\components\plugins\repositories\PluginFieldUuid;
use extas\components\plugins\TSnuffPlugins;
use extas\components\repositories\TSnuffRepository;
use extas\components\THasName;
use extas\interfaces\fields\IField;
use extas\interfaces\fields\IHasFields;
use extas\interfaces\stages\IStageInstallItem;
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
    use TSnuffPlugins;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->registerSnuffRepos([
            'fieldTypeRepository' => FieldTypeRepository::class,
            'fieldRepository' => FieldRepository::class,
            'pluginRepository' => PluginRepository::class,
            'extensionRepository' => ExtensionRepository::class,
            'entityRepository' => EntityRepository::class
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
        $this->createSnuffPlugin(PluginFieldUuid::class, ['extas.fields.create.before']);
        $this->createSnuffPlugin(InstallItem::class, [IStageInstallItem::NAME]);
        $plugin = new class ([
            InstallFields::FIELD__INPUT => $this->getInput(),
            InstallFields::FIELD__OUTPUT => $this->getOutput()
        ]) extends InstallFields {};
        $sectionData = [
            [Field::FIELD__NAME => 'test']
        ];
        $installer = new Installer();
        $plugin('fields', $sectionData, $installer);
        /**
         * @var IField $field
         */
        $field = $this->oneSnuffRepos('fieldRepository', [Field::FIELD__NAME => 'test']);
        $this->assertNotEmpty($field, 'Field is not installed');
        $this->assertNotEmpty($field->getId(), 'ID is not uuid, if it is empty');
    }

    public function testIHasFields()
    {
        $item = new class extends Item implements IHasFields {
            use THasFields;
            use THasName;

            public function getSubjectForFields(): string
            {
                return $this->getName();
            }

            protected function getSubjectForExtension(): string
            {
                return '';
            }
        };

        $fieldOptions = [
            'name' => 'test1',
            'value' => 'is ok',
            'parameters' => [
                'subject' => [
                    'name' => 'subject',
                    'value' => 'test is ok'
                ]
            ]
        ];

        $this->createWithSnuffRepo('fieldRepository', new Field($fieldOptions));

        $this->assertEmpty($item->getFields());
        $item->setName('test is ok');

        $this->assertCount(1, $item->getFields());
        $this->assertEquals(
            'is ok',
            $item->getFieldValue('test1'),
            'Current: '. $item->getFieldValue('test1')
        );
        $this->assertEquals(
            ['test1' => 'is ok'],
            $item->getFieldsValues(),
            'Current: ' . print_r($item->getFieldsValues(), true)
        );
        $this->assertEquals(
            $fieldOptions,
            $item->getFieldOptions('test1'),
            'Current: ' . print_r($item->getFieldOptions('test1'), true)
        );
        $this->assertEquals(
            ['test1' => $fieldOptions],
            $item->getFieldsOptions(),
            'Current: ' . print_r($item->getFieldsOptions(), true)
        );

        $fieldOptions['value'] = 'is ok again';
        $item->setFields([new Field($fieldOptions)]);
        $this->assertCount(1, $item->getFields());
        $this->assertEquals('is ok again', $item->getFieldValue('test1'));

        $fieldOptions['value'] = 'still is ok';
        $item->setFieldsByOptions([$fieldOptions]);
        $this->assertCount(1, $item->getFields());
        $this->assertEquals('still is ok', $item->getFieldValue('test1'));

        $item->setFieldsByValues(['test2' => 'is ok forever']);
        $this->assertCount(1, $item->getFields());
        $this->assertEquals('is ok forever', $item->getFieldValue('test2'));

        $this->expectExceptionMessage('Missed or unknown field "test1"');
        $item->getField('test1');
    }
}
