<?php

namespace Models\emvchelp;

use EasyMVC\Model\Model;

/**
 * Class DummyDataEasyMVCStyle
 *
 * This is an example of an EasyMVC model class.
 * This uses the EasyMVC extension for model classes.
 *
 * You set and get your data with following commands.
 * $ModelName->setData('KeyName', <value>);   <value> add single quotes for a string value
 * $ModelName->getData('KeyName');
 *
 * The advantage of using this model, is that it adapts automatically on any changes to the database. You don't need to
 * rewrite the model class when an extra field is added or deleted.
 *
 * @package Models
 */
class DummyDataEasyMVCStyle extends Model
{
    /**
     * @param array $data
     * @return DummyDataEasyMVCStyle
     */
    public static function new(array $data): DummyDataEasyMVCStyle
    {
        return new self($data);
    }
}
