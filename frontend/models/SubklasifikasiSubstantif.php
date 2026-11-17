<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subklasifikasi_substantif".
 *
 * @property string $kode_klasifikasi
 * @property string $kode_subklasifikasi
 * @property string $subklasifikasi
 *
 * @property KlasifikasiSubstantif $kodeKlasifikasi
 */
class SubklasifikasiSubstantif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subklasifikasi_substantif';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_klasifikasi', 'kode_subklasifikasi', 'subklasifikasi'], 'required'],
            [['kode_klasifikasi'], 'string', 'max' => 2],
            [['kode_subklasifikasi'], 'string', 'max' => 3],
            [['subklasifikasi'], 'string', 'max' => 255],
            [['kode_klasifikasi', 'kode_subklasifikasi'], 'unique', 'targetAttribute' => ['kode_klasifikasi', 'kode_subklasifikasi']],
            [['kode_klasifikasi'], 'exist', 'skipOnError' => true, 'targetClass' => KlasifikasiSubstantif::className(), 'targetAttribute' => ['kode_klasifikasi' => 'kode']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode_klasifikasi' => 'Kode Klasifikasi',
            'kode_subklasifikasi' => 'Kode Subklasifikasi',
            'subklasifikasi' => 'Subklasifikasi',
        ];
    }

    /**
     * Gets query for [[KodeKlasifikasi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKodeKlasifikasi()
    {
        return $this->hasOne(KlasifikasiSubstantif::className(), ['kode' => 'kode_klasifikasi']);
    }
}
