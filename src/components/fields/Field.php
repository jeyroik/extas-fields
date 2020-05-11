<?php
namespace extas\components\fields;

use extas\interfaces\fields\IField;
use extas\components\samples\THasSample;

/**
 * Class Field
 *
 * @package extas\components\fields
 * @author jeyroik@gmail.com
 */
class Field extends FieldSample implements IField
{
    use THasSample;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.field';
    }
}
