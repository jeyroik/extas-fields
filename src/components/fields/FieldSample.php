<?php
namespace extas\components\fields;

use extas\components\THasValue;
use extas\interfaces\fields\IFieldSample;
use extas\interfaces\fields\types\IFieldType;
use extas\components\samples\Sample;
use extas\components\THasType;

/**
 * Class FieldSample
 *
 * @method fieldTypeRepository()
 *
 * @package extas\components\fields
 * @author jeyroik@gmail.com
 */
class FieldSample extends Sample implements IFieldSample
{
    use THasType;
    use THasValue;

    /**
     * @return IFieldType|null
     */
    public function getTypeObject(): ?IFieldType
    {
        return $this->fieldTypeRepository()->one([IFieldType::FIELD__NAME => $this->getType()]);
    }
}
