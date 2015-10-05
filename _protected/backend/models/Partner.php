<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;
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
            [['name', 'summary_pt', 'description_pt', 'link'], 'required'],
            [['name', 'summary_en', 'summary_pt', 'description_en', 'description_pt', 'link', 'created_at', 'updated_at'], 'safe'],
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
            'summary_en' => Yii::t('app', 'Summary'),
            'summary_pt' => Yii::t('app', 'Summary'),
            'description_en' => Yii::t('app', 'Description'),
            'description_pt' => Yii::t('app', 'Description'),
            'link' => Yii::t('app', 'Link'),
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
                'type' => 'partner',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/../uploads/partner',
                'url' => Yii::getAlias('@web') . '/../uploads/partner',
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
