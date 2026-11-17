<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subklasifikasi_fasilitatif".
 *
 * @property string $kode_klasifikasi
 * @property string $kode_subklasifikasi
 * @property string $subklasifikasi
 *
 * @property KlasifikasiFasilitatif $kodeKlasifikasi
 * @property SubklasifikasiFasilitatif2[] $subklasifikasiFasilitatif2s
 */
class SubklasifikasiFasilitatif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subklasifikasi_fasilitatif';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_klasifikasi', 'kode_subklasifikasi', 'subklasifikasi'], 'required'],
            [['kode_klasifikasi'], 'string', 'max' => 2],
            [['kode_subklasifikasi'], 'string', 'max' => 4],
            [['subklasifikasi'], 'string', 'max' => 320],
            [['kode_klasifikasi', 'kode_subklasifikasi'], 'unique', 'targetAttribute' => ['kode_klasifikasi', 'kode_subklasifikasi']],
            [['kode_klasifikasi'], 'exist', 'skipOnError' => true, 'targetClass' => KlasifikasiFasilitatif::className(), 'targetAttribute' => ['kode_klasifikasi' => 'kode']],
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
        return $this->hasOne(KlasifikasiFasilitatif::className(), ['kode' => 'kode_klasifikasi']);
    }

    /**
     * Gets query for [[SubklasifikasiFasilitatif2s]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubklasifikasiFasilitatif2s()
    {
        return $this->hasMany(SubklasifikasiFasilitatif2::className(), ['kode_klasifikasi' => 'kode_klasifikasi', 'kode_subklasifikasi' => 'kode_subklasifikasi']);
    }
}
