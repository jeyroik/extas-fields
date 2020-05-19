<?php
namespace extas\components\fields;

use extas\components\THasId;
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
    use THasId;

    /**
     * @return string
     */
    protected function getSubjectForExtension(): string
    {
        return 'extas.field';
    }
}
