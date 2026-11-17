<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "klasifikasi_substantif".
 *
 * @property string $kode
 * @property string $klasifikasi
 *
 * @property SubklasifikasiSubstantif[] $subklasifikasiSubstantifs
 */
class KlasifikasiSubstantif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'klasifikasi_substantif';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['kode', 'klasifikasi'], 'required'],
            [['kode'], 'string', 'max' => 2],
            [['klasifikasi'], 'string', 'max' => 255],
            [['kode'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'kode' => 'Kode',
            'klasifikasi' => 'Klasifikasi',
        ];
    }

    /**
     * Gets query for [[SubklasifikasiSubstantifs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubklasifikasiSubstantifs()
    {
        return $this->hasMany(SubklasifikasiSubstantif::className(), ['kode_klasifikasi' => 'kode']);
    }
}
