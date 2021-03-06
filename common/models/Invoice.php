<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "invoice".
 *
 * @property integer $id
 * @property integer $sourceStore
 * @property integer $targetStore
 * @property string $created
 * @property integer $user
 */
class Invoice extends \yii\db\ActiveRecord
{

    public function getItems(){
        return $this->hasMany(InvoiceItem::className(), ['invoiceID' => 'id']);
    }

    public function setItems($items){
        if(empty($this->id)){
            if(empty($this->sourceStore) || empty($this->targetStore)){
                return;
            }

            $this->save(false);
        }

        foreach($items as $item){
            $item->invoiceID = $this->id;
            $item->save(false);
        }
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'invoice';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sourceStore', 'targetStore', 'user'], 'required'],
            [['sourceStore', 'targetStore', 'user'], 'integer'],
            [['created'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sourceStore' => 'Источник товаров',
            'targetStore' => 'Новый склад',
            'created' => 'Создано',
            'user' => 'Пользователь',
        ];
    }

    public function getSourceStoreModel(){
        return $this->hasOne(Store::className(), ['id' => 'sourceStore']);
    }

    public function getTargetStoreModel(){
        return $this->hasOne(Store::className(), ['id' => 'targetStore']);
    }

    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            $this->created = date('Y-m-d H:i:s');
            $this->user = \Yii::$app->user->id;
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }

}
