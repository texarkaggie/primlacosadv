<?php

namespace app\models;

use yii\behaviors\TimestampBehavior;
use zxbodya\yii2\galleryManager\GalleryBehavior;
use Yii;

/**
 * This is the model class for table "team".
 *
 * @property integer $id
 * @property string $name
 * @property string $role_en
 * @property string $role_pt
 * @property string $intro_en
 * @property string $intro_pt
 * @property integer $created_at
 * @property integer $updated_at
 */
class Team extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'team';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'role_pt', 'intro_pt'], 'required'],
            [['name', 'role_en', 'role_pt', 'intro_en', 'intro_pt', 'created_at', 'updated_at'], 'safe'],
            [['intro_en', 'intro_pt'], 'string'],
            [['created_at', 'updated_at'], 'integer'],
            [['name', 'role_en', 'role_pt'], 'string', 'max' => 255]
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
            'role_en' => Yii::t('app', 'Role'),
            'role_pt' => Yii::t('app', 'Role'),
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
                'type' => 'team',
                'extension' => 'jpg',
                'directory' => Yii::getAlias('@webroot') . '/../uploads/team',
                'url' => Yii::getAlias('@web') . '/../uploads/team',
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
