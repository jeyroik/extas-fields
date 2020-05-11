<?php
namespace extas\components\fields\types;

use extas\interfaces\fields\types\IFieldTypeSampleRepository;
use extas\components\repositories\Repository;

/**
 * Class FieldTypeSampleRepository
 * 
 * @package extas\components\fields\types
 * @author jeyroik@gmail.com
 */
class FieldTypeSampleRepository extends Repository implements IFieldTypeSampleRepository
{
    protected string $itemClass = FieldTypeSample::class;
    protected string $pk = FieldTypeSample::FIELD__NAME;
    protected string $name = 'fields_types_samples';
    protected string $scope = 'extas';
}
