<?php
namespace tests;

use extas\components\extensions\TSnuffExtensions;
use extas\components\fields\Field;
use extas\components\fields\types\FieldType;
use extas\components\fields\types\FieldTypeRepository;
use extas\interfaces\repositories\IRepository;
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
    use TSnuffExtensions;

    protected IRepository $typeRepo;

    protected function setUp(): void
    {
        parent::setUp();
        $env = Dotenv::create(getcwd() . '/tests/');
        $env->load();
        $this->typeRepo = new FieldTypeRepository();
        $this->addReposForExt([
            'fieldTypeRepository' => FieldTypeRepository::class
        ]);
    }

    protected function tearDown(): void
    {
        $this->deleteSnuffExtensions();
        $this->typeRepo->delete([FieldType::FIELD__NAME => 'string']);
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
}
