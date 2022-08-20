<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "service_games".
 *
 * @property int $id
 * @property int|null $service_id
 * @property int|null $games_id
 */
class ServiceGames extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'service_games';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['service_id', 'games_id'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'service_id' => 'Service ID',
            'games_id' => 'Games ID',
        ];
    }
}
