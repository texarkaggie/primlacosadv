<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "partner".
 *
 * @property integer $id
 * @property string $name
 * @property string $summary_en
 * @property string $summary_pt
 * @property string $description_en
 * @property string $description_pt
 * @property string $link
 * @property integer $created_at
 * @property integer $updated_at
 */
class Partner extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'partner';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'summary_en', 'summary_pt', 'description_en', 'description_pt', 'link', 'created_at', 'updated_at'], 'required'],
            [['summary_en', 'summary_pt', 'description_en', 'description_pt'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'link'], 'string', 'max' => 255]
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
            'summary_en' => Yii::t('app', 'Summary En'),
            'summary_pt' => Yii::t('app', 'Summary Pt'),
            'description_en' => Yii::t('app', 'Description En'),
            'description_pt' => Yii::t('app', 'Description Pt'),
            'link' => Yii::t('app', 'Link'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
