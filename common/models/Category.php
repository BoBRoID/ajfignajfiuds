<?php

namespace common\models;

use common\helpers\TranslitHelper;
use Yii;

/**
 * This is the model class for table "categories".
 *
 * @property integer $id
 * @property string $name
 * @property integer $parent
 * @property string $link
 * @property string $created
 * @property string $updated
 */
class Category extends \yii\db\ActiveRecord
{
    public function getChilds(){
        return $this->hasMany(self::className(), ['parent' => 'id']);
    }
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'categories';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent'], 'integer'],
            [['created', 'updated'], 'safe'],
            [['name', 'link'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'parent' => 'Parent',
            'link' => 'Link',
            'created' => 'Created',
            'updated' => 'Updated',
        ];
    }


    public function beforeSave($insert)
    {
        if($this->isNewRecord){
            $this->created = date('Y-m-d H:i:s');
        }

        if(empty($this->parent)){
            $this->parent = 0;
        }

        $this->updated = date('Y-m-d H:i:s');

        if($this->name != $this->getOldAttribute('name')){
            $this->link = TranslitHelper::to($this->name);
        }

        return parent::beforeSave($insert); // TODO: Change the autogenerated stub
    }
}
