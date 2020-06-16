<?php
namespace extas\components\fields;

use extas\components\exceptions\MissedOrUnknown;
use extas\interfaces\fields\IField;
use extas\interfaces\fields\IHasFields;
use extas\interfaces\repositories\IRepository;

/**
 * Trait THasFields
 *
 * @method IRepository fieldRepository()
 * @method abstract string getSubjectForFields()
 *
 * @package extas\components\fields
 * @author jeyroik <jeyroik@gmail.com>
 */
trait THasFields
{
    /**
     * @return IField[]
     */
    public function getFields(): array
    {
        return $this->fieldRepository()->all([IHasFields::PARAM__SUBJECT => $this->getSubjectForFields()]);
    }

    /**
     * @return array
     */
    public function getFieldsOptions(): array
    {
        $fields = $this->getFields();
        $options = [];

        foreach ($fields as $field) {
            $options[$field->getName()] = $field->__toArray();
        }

        return $options;
    }

    /**
     * @return array
     */
    public function getFieldsValues(): array
    {
        $fields = $this->getFields();
        $values = [];

        foreach ($fields as $field) {
            $options[$field->getName()] = $field->getValue();
        }

        return $values;
    }

    /**
     * @param string $name
     * @return IField
     * @throws MissedOrUnknown
     */
    public function getField(string $name): IField
    {
        $field = $this->fieldRepository()->one([
            IHasFields::PARAM__SUBJECT => $this->getSubjectForFields(),
            IField::FIELD__NAME => $name
        ]);

        if (!$field) {
            throw new MissedOrUnknown('field "' . $name . '"');
        }

        return $field;
    }

    /**
     * @param string $name
     * @return array
     * @throws MissedOrUnknown
     */
    public function getFieldOptions(string $name): array
    {
        return $this->getField($name)->__toArray();
    }

    /**
     * @param string $name
     * @param mixed $default
     * @return mixed
     * @throws MissedOrUnknown
     */
    public function getFieldValue(string $name, $default = null)
    {
        return $this->getField($name)->getValue($default);
    }

    /**
     * @param IField[] $fields
     * @return $this
     */
    public function setFields(array $fields)
    {
        $repo = $this->fieldRepository();
        $repo->delete([IHasFields::PARAM__SUBJECT => $this->getSubjectForFields()]);

        foreach ($fields as $field) {
            $field->addParameterByValue('subject', $this->getSubjectForFields());
            $repo->create($field);
        }

        return $this;
    }

    /**
     * @param array $options
     * @return $this
     */
    public function setFieldsByOptions(array $options)
    {
        $repo = $this->fieldRepository();
        $repo->delete([IHasFields::PARAM__SUBJECT => $this->getSubjectForFields()]);

        foreach ($options as $fieldOptions) {
            $field = new Field($fieldOptions);
            $field->addParameterByValue('subject', $this->getSubjectForFields());
            $repo->create($field);
        }

        return $this;
    }

    /**
     * @param array $values
     * @return $this
     */
    public function setFieldsByValues(array $values)
    {
        $repo = $this->fieldRepository();
        $repo->delete([IHasFields::PARAM__SUBJECT => $this->getSubjectForFields()]);

        foreach ($values as $fieldName => $fieldValue) {
            $field = new Field([
                Field::FIELD__NAME => $fieldName,
                Field::FIELD__VALUE => $fieldValue
            ]);
            $field->addParameterByValue('subject', $this->getSubjectForFields());
            $repo->create($field);
        }

        return $this;
    }
}
