<?php

namespace rusmd89\seo\models;

use rusmd89\seo\components\RegexpValidator;
use Yii;

/**
 * This is the model class for table "meta_tags".
 *
 * @property integer $id
 * @property string $name
 * @property string $code
 * @property string $route
 * @property string $title
 * @property string $description
 * @property string $keywords
 *
 * @property SeoPageTags[] $tags
 */
class SeoPage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'seo_page';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'description', 'keywords'], 'string'],
            [['name', 'code', 'route'], 'string', 'max' => 255],
            [['route'], RegexpValidator::class, 'allowEmpty' => true],
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
            'code' => Yii::t('app', 'Code'),
            'route' => Yii::t('app', 'Route (Reg Exp)'),
            'title' => Yii::t('app', 'Title'),
            'description' => Yii::t('app', 'Description'),
            'keywords' => Yii::t('app', 'Keywords'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTags()
    {
        return $this->hasMany(SeoPageTags::class, ['seo_page_id' => 'id']);
    }
}