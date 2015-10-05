<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use Yii;

/**
 * This is the model class for table "campaign".
 *
 * @property integer $id
 * @property string $name_en
 * @property string $name_pt
 * @property string $intro_en
 * @property string $intro_pt
 * @property integer $created_at
 * @property integer $updated_at
 */
class Campaign extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'campaign';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name_pt', 'intro_pt'], 'required'],
            [['name_en', 'name_pt', 'intro_en', 'intro_pt', 'created_at', 'updated_at'], 'safe'],
            [['intro_en', 'intro_pt'], 'string'],
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
            'name_en' => Yii::t('app', 'Name'),
            'name_pt' => Yii::t('app', 'Name'),
            'intro_en' => Yii::t('app', 'Intro'),
            'intro_pt' => Yii::t('app', 'Intro'),
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
                'type' => 'campaign',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/uploads/campaign',
                'url' => Yii::getAlias('@web') . '/uploads/campaign',
                'versions' => [
                    'small' => function ($img) {
                        /** @var \Imagine\Image\ImageInterface $img */
                        return $img
                            ->copy()
                            ->thumbnail(new \Imagine\Image\Box(200, 200));
                    },
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
