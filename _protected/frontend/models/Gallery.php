<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "gallery".
 *
 * @property integer $id
 * @property string $title_en
 * @property string $title_pt
 * @property string $summary_en
 * @property string $summary_pt
 * @property integer $created_at
 * @property integer $updated_at
 */
class Gallery extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'gallery';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title_en', 'title_pt', 'summary_en', 'summary_pt', 'created_at', 'updated_at'], 'required'],
            [['summary_en', 'summary_pt'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['title_en', 'title_pt'], 'string', 'max' => 255]
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
                'type' => 'gallery',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/uploads/gallery',
                'url' => Yii::getAlias('@web') . '/uploads/gallery',
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

