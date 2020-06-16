<?php
namespace extas\interfaces\fields;

use extas\components\exceptions\MissedOrUnknown;
use extas\interfaces\samples\parameters\IHasSampleParameters;

/**
 * Interface IHasFields
 * 
 * @package extas\interfaces\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
interface IHasFields
{
    public const PARAM__SUBJECT = IHasSampleParameters::FIELD__PARAMETERS . '.subject.value';

    /**
     * @return IField[]
     */
    public function getFields(): array;

    /**
     * @return array
     */
    public function getFieldsOptions(): array;

    /**
     * @return array
     */
    public function getFieldsValues(): array;

    /**
     * @param string $name
     * @return IField
     * @throws MissedOrUnknown
     */
    public function getField(string $name): IField;

    /**
     * @param string $name
     * @return array
     * @throws MissedOrUnknown
     */
    public function getFieldOptions(string $name): array;

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     * @throws MissedOrUnknown
     */
    public function getFieldValue(string $name, $default = null);

    /**
     * @param array $fields
     * @return $this
     */
    public function setFields(array $fields);

    /**
     * @param array $options
     * @return $this
     */
    public function setFieldsByOptions(array $options);

    /**
     * @param array $values
     * @return $this
     */
    public function setFieldsByValues(array $values);

    /**
     * @return string
     */
    public function getSubjectForFields(): string;
}
