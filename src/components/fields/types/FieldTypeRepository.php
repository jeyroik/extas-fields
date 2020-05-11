<?php
namespace extas\components\fields\types;

use extas\interfaces\fields\types\IFieldTypeRepository;
use extas\components\repositories\Repository;

/**
 * Class FieldTypeRepository
 *
 * @package extas\components\fields\types
 * @author jeyroik@gmail.com
 */
class FieldTypeRepository extends Repository implements IFieldTypeRepository
{
    protected string $itemClass = FieldType::class;
    protected string $pk = FieldType::FIELD__NAME;
    protected string $name = 'fields_types';
    protected string $scope = 'extas';
}
