<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "tbl_post".
 *
 * @property int $id
 * @property string $title
 * @property string $slug
 * @property string $body
 * @property string|null $img_loc1
 * @property string|null $img_loc2
 * @property int $user_id
 * @property int $category_id
 * @property string $created_at
 *
 * @property TblCategory $category
 * @property TblUser $user
 */
class Post extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'tbl_post';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['title', 'slug', 'body', 'user_id', 'category_id'], 'required'],
            [['user_id', 'category_id'], 'integer'],
            [['created_at'], 'safe'],
            [['title'], 'string', 'max' => 45],
            [['slug'], 'string', 'max' => 50],
            [['body'], 'string', 'max' => 800],
            [['img_loc1', 'img_loc2'], 'string', 'max' => 80],
            [['category_id'], 'exist', 'skipOnError' => true, 'targetClass' => Category::className(), 'targetAttribute' => ['category_id' => 'id']],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
            'slug' => 'Slug',
            'body' => 'Body',
            'img_loc1' => 'Img Loc1',
            'img_loc2' => 'Img Loc2',
            'user_id' => 'User ID',
            'category_id' => 'Category ID',
            'created_at' => 'Created At',
        ];
    }

    /**
     * Gets query for [[Category]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(TblCategory::className(), ['id' => 'category_id']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(TblUser::className(), ['id' => 'user_id']);
    }
}
