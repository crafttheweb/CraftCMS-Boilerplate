<?php
namespace Craft;

class CodeBlocksModel extends BaseModel
{
    protected function defineAttributes()
    {
        return array(
            'handle'        => AttributeType::String,
            'text'          => AttributeType::String,
            'mode'          => AttributeType::String,
        );
    }
}