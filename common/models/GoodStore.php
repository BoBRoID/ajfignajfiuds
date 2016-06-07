<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "goodsStore".
 *
 * @property integer $goodID
 * @property integer $storeID
 * @property integer $count
 */
class GoodStore extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'goodsStore';
    }

    public function getStore(){
        return $this->hasOne(Store::className(), ['id' => 'storeID']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['goodID', 'storeID'], 'required'],
            [['goodID', 'storeID', 'count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'goodID' => 'Good ID',
            'storeID' => 'Store ID',
            'count' => 'Count',
        ];
    }
}
