<?php

namespace app\models;

use yii\db\ActiveRecord;

class Posts extends ActiveRecord
{
    private $title;
    private $description;
    private $categroy;

    public function rules()
    {
        return [
            [['title', 'description', 'categroy'], 'required'],
            [['description'], 'string'],
            [['title', 'categroy'], 'string', 'max' => 255],
        ];
    }
}