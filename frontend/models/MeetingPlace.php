<?php

namespace frontend\models;

use Yii;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "meeting_place".
 *
 * @property integer $id
 * @property integer $meeting_id
 * @property integer $place_id
 * @property integer $suggested_by
 * @property integer $status
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property Meeting $meeting
 * @property Place $place
 * @property User $suggestedBy
 */
class MeetingPlace extends \yii\db\ActiveRecord
{
    const STATUS_SUGGESTED =0;
    const STATUS_SELECTED =0;
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'meeting_place';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['meeting_id', 'place_id', 'suggested_by'], 'required'],
            [['meeting_id', 'place_id', 'suggested_by', 'status', 'created_at', 'updated_at'], 'integer']
        ];
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'attributes' => [
                    ActiveRecord::EVENT_BEFORE_INSERT => ['created_at', 'updated_at'],
                    ActiveRecord::EVENT_BEFORE_UPDATE => ['updated_at'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('frontend', 'ID'),
            'meeting_id' => Yii::t('frontend', 'Meeting ID'),
            'place_id' => Yii::t('frontend', 'Place ID'),
            'suggested_by' => Yii::t('frontend', 'Suggested By'),
            'status' => Yii::t('frontend', 'Status'),
            'created_at' => Yii::t('frontend', 'Created At'),
            'updated_at' => Yii::t('frontend', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getMeeting()
    {
        return $this->hasOne(Meeting::className(), ['id' => 'meeting_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPlace()
    {
        return $this->hasOne(Place::className(), ['id' => 'place_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSuggestedBy()
    {
        return $this->hasOne(User::className(), ['id' => 'suggested_by']);
    }
}
