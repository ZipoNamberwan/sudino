<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "surat_masuk".
 *
 * @property string $no_surat
 * @property string $tgl_surat
 * @property string $dari
 * @property string $kepada
 * @property string $perihal 
 * @property string $catatan
 * @property int $id_user
 *
 * @property User $user
 */
class SuratMasuk extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'surat_masuk';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['no_surat', 'tgl_surat', 'dari', 'kepada', 'perihal', 'id_user'], 'required'],
            [['tgl_surat'], 'safe'],
            [['perihal', 'catatan'], 'string'],
            [['id_user'], 'integer'],
            [['no_surat'], 'string', 'max' => 30],
            [['dari', 'kepada'], 'string', 'max' => 150],
            [['no_surat'], 'unique'],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'no_surat' => 'Nomor Surat',
            'tgl_surat' => 'Tanggal Surat',
            'dari' => 'Dari',
            'kepada' => 'Diteruskan Kepada',
            'perihal' => 'Perihal',
            'catatan' => 'Catatan',
            'id_user' => 'Penginput',
        ];
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
