<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;
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
            [['title_pt', 'summary_pt', 'content_pt'], 'required'],
            [['title_en', 'title_pt', 'summary_en', 'summary_pt', 'content_en', 'content_pt', 'created_at', 'updated_at'], 'safe'],
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
            'title_en' => Yii::t('app', 'Title'),
            'title_pt' => Yii::t('app', 'Title'),
            'summary_en' => Yii::t('app', 'Summary'),
            'summary_pt' => Yii::t('app', 'Summary'),
            'content_en' => Yii::t('app', 'Content'),
            'content_pt' => Yii::t('app', 'Content'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }
    
    /**
     * Returns a list of behaviors that this component should behave as.
     *
     * @return array
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::className(),
            'galleryBehavior' => [
                'class' => GalleryBehavior::className(),
                'type' => 'publication',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/../uploads/publication',
                'url' => Yii::getAlias('@web') . '/../uploads/publication',
                'versions' => [
                    'medium' => function ($img) {
                        /** @var Imagine\Image\ImageInterface $img */
                        $dstSize = $img->getSize();
                        $maxWidth = 800;
                        if ($dstSize->getWidth() > $maxWidth) {
                            $dstSize = $dstSize->widen($maxWidth);
                        }
                        return $img
                            ->copy()
                            ->resize($dstSize);
                    },
                ]
            ],
        ];
    }
}
