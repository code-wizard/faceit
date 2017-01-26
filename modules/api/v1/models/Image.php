<?php

namespace app\modules\api\v1\models;

use Yii;
use yii\helpers\Url;

/**
 * This is the model class for table "image".
 *
 * @property integer $id
 * @property string $name
 * @property integer $width
 * @property integer $height
 * @property string $link
 *
 * @property Faces[] $faces
 */
class Image extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'image';
    }

    public function fields(){
        return ["id","name","width","height","link"=>function($model){
                return Url::base(true).$model->link;
            },"faces"];
    }
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['width', 'height'], 'integer'],
            [['name'], 'string', 'max' => 40],
            [['link'], 'string', 'max' => 1000],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Name'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'link' => Yii::t('app', 'Link'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getFaces()
    {
        return $this->hasMany(Face::className(), ['image_id' => 'id']);
    }
}
