<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;

/**
 * This is the model class for table "about".
 *
 * @property integer $id
 * @property string $name_en
 * @property string $name_pt
 * @property string $intro_en
 * @property string $intro_pt
 * @property string $content_en
 * @property string $content_pt
 * @property integer $created_at
 * @property integer $updated_at
 */
class About extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'about';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_en', 'name_pt', 'intro_en', 'intro_pt', 'content_en', 'content_pt', 'created_at', 'updated_at'], 'required'],
            [['intro_en', 'intro_pt', 'content_en', 'content_pt'], 'string'],
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
            'intro_en' => Yii::t('app', 'Intro En'),
            'intro_pt' => Yii::t('app', 'Intro Pt'),
            'content_en' => Yii::t('app', 'Content En'),
            'content_pt' => Yii::t('app', 'Content Pt'),
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
                'type' => 'about',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/uploads/about',
                'url' => Yii::getAlias('@web') . '/uploads/about',
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
