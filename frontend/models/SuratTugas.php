<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "surat_tugas".
 *
 * @property string $id_unit
 * @property string $id_surat
 * @property string $no_surat
 * @property string $tgl_surat
 * @property string $perihal
 * @property string $tujuan
 * @property int $id_user
 *
 * @property MSatuanOrganisasi $unit
 */
class SuratTugas extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'surat_tugas';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_surat', 'no_surat', 'tgl_surat', 'perihal', 'tujuan', 'id_user'], 'required'],
            [['tgl_surat'], 'safe'],
            [['perihal'], 'string'],
            [['id_user'], 'integer'],
            [['id_unit'], 'string', 'max' => 8],
            [['id_surat'], 'string', 'max' => 9],
            [['no_surat'], 'string', 'max' => 30],
            [['tujuan'], 'string', 'max' => 255],
            [['id_unit', 'id_surat'], 'unique', 'targetAttribute' => ['id_unit', 'id_surat']],
            [['id_unit'], 'exist', 'skipOnError' => true, 'targetClass' => MSatuanOrganisasi::className(), 'targetAttribute' => ['id_unit' => 'id']],
            [['id_user'], 'exist', 'skipOnError' => true, 'targetClass' => User::className(), 'targetAttribute' => ['id_user' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_unit' => 'Satuan Organisasi',
            'id_surat' => 'Id Surat Tugas',
            'no_surat' => 'Nomor Surat Tugas',
            'tgl_surat' => 'Tanggal Surat Tugas',
            'perihal' => 'Perihal',
            'tujuan' => 'Tujuan Surat Tugas',
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
        return $this->hasOne(MSatuanOrganisasi::className(), ['id' => 'id_unit']);
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
