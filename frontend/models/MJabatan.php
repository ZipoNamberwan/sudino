<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "m_jabatan".
 *
 * @property string $id
 * @property string $nama_jabatan
 */
class MJabatan extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'm_jabatan';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'nama_jabatan'], 'required'],
            [['id'], 'string', 'max' => 4],
            [['nama_jabatan'], 'string', 'max' => 255],
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
            'nama_jabatan' => 'Nama Jabatan',
        ];
    }
}
