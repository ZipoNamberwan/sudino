<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_satuan_organisasi".
 *
 * @property string $id
 * @property string $satuan_organisasi
 *
 * @property Surat[] $surats
 */
class MSatuanOrganisasi extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_satuan_organisasi';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'satuan_organisasi'], 'required'],
            [['id'], 'string', 'max' => 8],
            [['satuan_organisasi'], 'string', 'max' => 255],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'satuan_organisasi' => 'Satuan Organisasi',
        ];
    }

    /**
     * Gets query for [[Surats]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getSurats()
    {
        return $this->hasMany(Surat::className(), ['id_unit' => 'id']);
    }
}
