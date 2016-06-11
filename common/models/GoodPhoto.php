<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "goodsPhotos".
 *
 * @property integer $id
 * @property integer $goodID
 * @property integer $order
 * @property string $link
 */
class GoodPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goodsPhotos';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodID', 'order'], 'integer'],
            [['link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'goodID' => 'Good ID',
            'order' => 'Order',
            'link' => 'Link',
        ];
    }
}
