<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "klasifikasi_fasilitatif".
 *
 * @property string $kode
 * @property string $klasifikasi
 *
 * @property SubklasifikasiFasilitatif[] $subklasifikasiFasilitatifs
 */
class KlasifikasiFasilitatif extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'klasifikasi_fasilitatif';
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
     * Gets query for [[SubklasifikasiFasilitatifs]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSubklasifikasiFasilitatifs()
    {
        return $this->hasMany(SubklasifikasiFasilitatif::className(), ['kode_klasifikasi' => 'kode']);
    }
}
