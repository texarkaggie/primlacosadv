<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;
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
            [['name_pt', 'description_pt'], 'required'],
            [['name_en', 'name_pt', 'description_en', 'description_pt'], 'safe'],
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
            'name_en' => Yii::t('app', 'Name'),
            'name_pt' => Yii::t('app', 'Name'),
            'description_en' => Yii::t('app', 'Description'),
            'description_pt' => Yii::t('app', 'Description'),
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
                'type' => 'category',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/../uploads/category',
                'url' => Yii::getAlias('@web') . '/../uploads/category',
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
