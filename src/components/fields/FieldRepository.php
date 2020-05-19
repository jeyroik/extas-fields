<?php
namespace extas\components\fields;

use extas\interfaces\fields\IFieldRepository;
use extas\components\repositories\Repository;

/**
 * Class FieldRepository
 * 
 * @package extas\components\fields
 * @author jeyroik@gmail.com
 */
class FieldRepository extends Repository implements IFieldRepository
{
    protected string $scope = 'extas';
    protected string $name = 'fields';
    protected string $pk = Field::FIELD__ID;
    protected string $itemClass = Field::class;
}
