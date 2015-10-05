<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use Yii;

/**
 * This is the model class for table "service".
 *
 * @property integer $id
 * @property integer $category_id
 * @property string $sku
 * @property string $title_en
 * @property string $title_pt
 * @property string $summary_en
 * @property string $summary_pt
 * @property string $description_en
 * @property string $description_pt
 * @property string $availability_en
 * @property string $availability_pt
 * @property string $price
 * @property integer $promo
 * @property string $promo_txt_en
 * @property string $promo_txt_pt
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Category $category
 */
class Service extends \yii\db\ActiveRecord
{
    
    public $catName;
    
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'service';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'title_pt',  'summary_pt',  'description_pt', 'availability_pt', 'promo'], 'required'],
            [['category_id', 'created_at', 'updated_at', 'promo'], 'integer'],
            [['summary_en', 'summary_pt', 'description_en', 'description_pt', 'availability_en', 'availability_pt', 'promo_txt_en', 'promo_txt_pt'], 'string'],
            [['price'], 'number'],
            [['sku'], 'string', 'max' => 25],
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
            'category_id' => Yii::t('app', 'Category'),
            'catName' => Yii::t('app', 'Category'),
            'sku' => Yii::t('app', 'Sku'),
            'title_en' => Yii::t('app', 'Title'),
            'title_pt' => Yii::t('app', 'Title'),
            'summary_en' => Yii::t('app', 'Summary'),
            'summary_pt' => Yii::t('app', 'Summary'),
            'description_en' => Yii::t('app', 'Description'),
            'description_pt' => Yii::t('app', 'Description'),
            'availability_en' => Yii::t('app', 'Availability'),
            'availability_pt' => Yii::t('app', 'Availability'),
            'price' => Yii::t('app', 'Price'),
            'promo' => Yii::t('app', 'Highlight'),
            'promo_txt_en' => Yii::t('app', 'Highlight Intro'),
            'promo_txt_pt' => Yii::t('app', 'Highlight Intro'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
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
                'type' => 'service',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/../uploads/service',
                'url' => Yii::getAlias('@web') . '/../uploads/service',
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
