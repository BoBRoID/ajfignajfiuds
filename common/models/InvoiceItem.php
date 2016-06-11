<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoiceItems".
 *
 * @property integer $invoiceID
 * @property integer $goodID
 * @property integer $count
 */
class InvoiceItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoiceItems';
    }

    public static function find(){
        return parent::find()->with('good');
    }

    public function getGood(){
        return $this->hasOne(Good::className(), ['id' => 'goodID']);
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['invoiceID', 'goodID', 'count'], 'required'],
            [['invoiceID', 'goodID', 'count'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'invoiceID' => 'Накладная',
            'goodID' => 'Товар',
            'count' => 'Колличество',
        ];
    }
}
