<?php
namespace extas\components\fields;

use extas\interfaces\fields\IFieldSampleRepository;
use extas\components\repositories\Repository;

/**
 * Class FieldSampleRepository
 *
 * @package extas\components\fields
 * @author jeyroik@gmail.com
 */
class FieldSampleRepository extends Repository implements IFieldSampleRepository
{
    protected string $itemClass = FieldSample::class;
    protected string $pk = FieldSample::FIELD__NAME;
    protected string $name = 'fields_samples';
    protected string $scope = 'extas';
}
