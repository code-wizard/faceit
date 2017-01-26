<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "faces".
 *
 * @property integer $id
 * @property integer $image_id
 * @property string $confident_level
 * @property integer $width
 * @property integer $height
 * @property string $gender
 * @property integer $top_left_x
 * @property integer $top_left_y
 *
 * @property Image $image
 */
class Face extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'faces';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['image_id'], 'required'],
            [['image_id', 'width', 'height', 'top_left_x', 'top_left_y'], 'integer'],
            [['confident_level'], 'string', 'max' => 11],
            [['gender'], 'string', 'max' => 255],
            [['image_id'], 'exist', 'skipOnError' => true, 'targetClass' => Image::className(), 'targetAttribute' => ['image_id' => 'id']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'image_id' => Yii::t('app', 'Image ID'),
            'confident_level' => Yii::t('app', 'Confident Level'),
            'width' => Yii::t('app', 'Width'),
            'height' => Yii::t('app', 'Height'),
            'gender' => Yii::t('app', 'Gender'),
            'top_left_x' => Yii::t('app', 'Top Left X'),
            'top_left_y' => Yii::t('app', 'Top Left Y'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getImage()
    {
        return $this->hasOne(Image::className(), ['id' => 'image_id']);
    }
}
