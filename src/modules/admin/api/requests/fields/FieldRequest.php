<?php

namespace ozerich\shop\modules\admin\api\requests\fields;

use ozerich\api\request\RequestModel;

class FieldRequest extends RequestModel
{
    public $name;

    public $type;

    public $group_id;

    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            ['group_id', 'integer']
        ];
    }
}