<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "publication".
 *
 * @property integer $id
 * @property string $title_en
 * @property string $title_pt
 * @property string $summary_en
 * @property string $summary_pt
 * @property string $content_en
 * @property string $content_pt
 * @property integer $created_at
 * @property integer $updated_at
 */
class Publication extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'publication';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_en', 'title_pt', 'summary_en', 'summary_pt', 'content_en', 'content_pt', 'created_at', 'updated_at'], 'required'],
            [['title_pt', 'summary_en', 'summary_pt', 'content_en', 'content_pt'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['title_en'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'title_en' => Yii::t('app', 'Title En'),
            'title_pt' => Yii::t('app', 'Title Pt'),
            'summary_en' => Yii::t('app', 'Summary En'),
            'summary_pt' => Yii::t('app', 'Summary Pt'),
            'content_en' => Yii::t('app', 'Content En'),
            'content_pt' => Yii::t('app', 'Content Pt'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
}
