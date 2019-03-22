<?php

namespace ozerich\shop\models;

use ozerich\shop\constants\FieldType;

/**
 * This is the model class for table "fields".
 *
 * @property int $id
 * @property string $name
 * @property string $type
 * @property string[] $values
 * @property integer $group_id
 * @property integer $image_id
 * @property integer $category_id
 * @property string $value_suffix
 * @property string $value_prefix
 * @property boolean $multiple
 *
 * @property FieldGroup $group
 * @property Image $image
 * @property Category $category
 */
class Field extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'fields';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'type'], 'required'],
            [['image_id', 'group_id'], 'integer'],
            [['name', 'type', 'value_suffix', 'value_prefix'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Название',
            'type' => 'Тип',
            'values' => 'Значения',
            'group_id' => 'Группа',
            'image_id' => 'Картинка',
            'value_suffix' => 'Суффикс у значения',
            'value_prefix' => 'Префикс у значения'
        ];
    }

    public function getGroup()
    {
        return $this->hasOne(FieldGroup::class, ['id' => 'group_id']);
    }

    public function getCategory()
    {
        return $this->hasOne(Category::class, ['id' => 'category_id']);
    }

    public function getImage()
    {
        return $this->hasOne(Image::class, ['id' => 'image_id']);
    }

    public function afterFind()
    {
        $this->values = $this->values ? explode(';', $this->values) : [];

        parent::afterFind();
    }

    public function beforeSave($insert)
    {
        if ($this->type == FieldType::SELECT) {
            $parts = $this->values && is_string($this->values) ? preg_split('/\n+/', $this->values) : (is_array($this->values) ? $this->values : []);
            $parts = array_map(function ($item) {
                return trim($item);
            }, array_filter($parts, function ($part) {
                return !empty(trim($part));
            }));

            $this->values = implode(';', $parts);
        } else {
            $this->values = null;
        }


        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }


}
