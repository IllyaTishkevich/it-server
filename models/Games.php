<?php

namespace app\models;

use Yii;
use yii\web\UploadedFile;

/**
 * This is the model class for table "games".
 *
 * @property int $id
 * @property string|null $name
 * @property string|null $description
 * @property string|null $img
 * @property array|[] $services
 */
class Games extends \yii\db\ActiveRecord
{
    public $services = [];

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'games';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'description', 'img'], 'string'],
            [['services'], 'array']
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'description' => 'Description',
            'services' => '',
            [['img'], 'file', 'skipOnEmpty' => false, 'extensions' => 'png, jpg'],
        ];
    }

    public function upload($image) {
        if (true) {
            $image->saveAs('./../web/uploads/' . $image->name);
            return true;
        } else {
            return false;
        }
    }

}
