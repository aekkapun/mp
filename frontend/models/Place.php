<?php

namespace frontend\models;

use Yii;

/**
 * This is the model class for table "Place".
 *
 * @property integer $id
 * @property string $name
 * @property integer $place_type
 * @property integer $status
 * @property string $ext_id
 * @property string $ext_reference
 * @property integer $created_by
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property MeetingPlace[] $meetingPlaces
 * @property User $createdBy
 * @property TemplatePlace[] $templatePlaces
 * @property UserPlace[] $userPlaces
 */
class Place extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'Place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'ext_id', 'created_by', 'created_at', 'updated_at'], 'required'],
            [['place_type', 'status', 'created_by', 'created_at', 'updated_at'], 'integer'],
            [['ext_reference'], 'string'],
            [['name', 'ext_id'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Name',
            'place_type' => 'Place Type',
            'status' => 'Status',
            'ext_id' => 'Ext ID',
            'ext_reference' => 'Ext Reference',
            'created_by' => 'Created By',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeetingPlaces()
    {
        return $this->hasMany(MeetingPlace::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCreatedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'created_by']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTemplatePlaces()
    {
        return $this->hasMany(TemplatePlace::className(), ['place_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUserPlaces()
    {
        return $this->hasMany(UserPlace::className(), ['place_id' => 'id']);
    }
}
