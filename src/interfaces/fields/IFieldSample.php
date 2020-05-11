<?php
namespace extas\interfaces\fields;

use extas\interfaces\fields\types\IFieldType;
use extas\interfaces\IHasType;
use extas\interfaces\IHasValue;
use extas\interfaces\samples\ISample;

/**
 * Interface IFieldSample
 *
 * @package extas\interfaces\fields
 * @author jeyroik@gmail.com
 */
interface IFieldSample extends ISample, IHasType, IHasValue
{
    /**
     * @return IFieldType|null
     */
    public function getTypeObject(): ?IFieldType;
}
