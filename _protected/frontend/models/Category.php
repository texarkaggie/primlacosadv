<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $name_en
 * @property string $name_pt
 * @property string $description_en
 * @property string $description_pt
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Service[] $services
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_en', 'name_pt', 'description_en', 'description_pt', 'created_at', 'updated_at'], 'required'],
            [['description_en', 'description_pt'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name_en', 'name_pt'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name_en' => Yii::t('app', 'Name En'),
            'name_pt' => Yii::t('app', 'Name Pt'),
            'description_en' => Yii::t('app', 'Description En'),
            'description_pt' => Yii::t('app', 'Description Pt'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getServices()
    {
        return $this->hasMany(Service::className(), ['category_id' => 'id']);
    }
}
