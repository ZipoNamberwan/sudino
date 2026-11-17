<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "memo".
 *
 * @property string $id_unit
 * @property string $id_memo
 * @property string $no_memo
 * @property string $tgl_memo
 * @property string $perihal
 * @property string $tujuan
 * @property int $id_user
 *
 * @property MJabatan $unit
 * @property User $user
 */
class Memo extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'memo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_memo', 'no_memo', 'tgl_memo', 'perihal', 'tujuan', 'id_user'], 'required'],
            [['tgl_memo'], 'safe'],
            [['perihal'], 'string'],
            [['id_user'], 'integer'],
            [['id_unit'], 'string', 'max' => 7],
            [['id_memo'], 'string', 'max' => 9],
            [['no_memo'], 'string', 'max' => 30],
            [['tujuan'], 'string', 'max' => 255],
            [['id_unit', 'id_memo'], 'unique', 'targetAttribute' => ['id_unit', 'id_memo']],
			//[['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => MJabatan::className(), 'targetAttribute' => ['id_unit' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_unit' => 'Jabatan Penandatangan',
            'id_memo' => 'Id Memo',
            'no_memo' => 'Nomor Memo',
            'tgl_memo' => 'Tanggal Memo',
            'perihal' => 'Perihal',
            'tujuan' => 'Tujuan Memo',
            'id_user' => 'Pembuat',
        ];
    }
	
	/**
     * Gets query for [[Unit]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUnit()
    {
        return $this->hasOne(MJabatan::className(), ['id' => 'id_unit']);
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'id_user']);
    }
}
