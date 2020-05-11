<?php
namespace extas\components\fields\types;

use extas\components\fields\types\FieldTypeSample;
use extas\interfaces\fields\types\IFieldType;
use extas\components\samples\THasSample;

/**
 * Class FieldType
 * 
 * @package extas\components\fields
 * @author jeyroik@gmail.com
 */
class FieldType extends FieldTypeSample implements IFieldType
{
    use THasSample;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.field.type';
    }
}
