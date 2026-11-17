<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "subklasifikasi_fasilitatif2".
 *
 * @property string $kode_klasifikasi
 * @property string $kode_subklasifikasi
 * @property string $kode_subklasifikasi2
 * @property string $subklasifikasi2
 *
 * @property SubklasifikasiFasilitatif $kodeKlasifikasi
 */
class SubklasifikasiFasilitatif2 extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'subklasifikasi_fasilitatif2';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode_klasifikasi', 'kode_subklasifikasi', 'kode_subklasifikasi2', 'subklasifikasi2'], 'required'],
            [['kode_klasifikasi', 'kode_subklasifikasi2'], 'string', 'max' => 2],
            [['kode_subklasifikasi'], 'string', 'max' => 3],
            [['subklasifikasi2'], 'string', 'max' => 255],
            [['kode_klasifikasi', 'kode_subklasifikasi', 'kode_subklasifikasi2'], 'unique', 'targetAttribute' => ['kode_klasifikasi', 'kode_subklasifikasi', 'kode_subklasifikasi2']],
            [['kode_klasifikasi', 'kode_subklasifikasi'], 'exist', 'skipOnError' => true, 'targetClass' => SubklasifikasiFasilitatif::className(), 'targetAttribute' => ['kode_klasifikasi' => 'kode_klasifikasi', 'kode_subklasifikasi' => 'kode_subklasifikasi']],
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
            'kode_subklasifikasi2' => 'Kode Subklasifikasi2',
            'subklasifikasi2' => 'Subklasifikasi2',
        ];
    }

    /**
     * Gets query for [[KodeKlasifikasi]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getKodeKlasifikasi()
    {
        return $this->hasOne(SubklasifikasiFasilitatif::className(), ['kode_klasifikasi' => 'kode_klasifikasi', 'kode_subklasifikasi' => 'kode_subklasifikasi']);
    }
}
