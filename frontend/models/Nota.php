<?php

namespace app\models;

use Yii;
use common\models\User;

/**
 * This is the model class for table "nota".
 *
 * @property string $id_unit
 * @property string $id_nota
 * @property string $no_nota
 * @property string $tgl_nota
 * @property string $perihal
 * @property string $tujuan
 * @property int $id_user
 *
 * @property MJabatan $unit
 * @property User $user
 */
class Nota extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'nota';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_nota', 'no_nota', 'tgl_nota', 'perihal', 'tujuan', 'id_user'], 'required'],
            [['tgl_nota'], 'safe'],
            [['perihal'], 'string'],
            [['id_user'], 'integer'],
            [['id_unit'], 'string', 'max' => 7],
            [['id_nota'], 'string', 'max' => 9],
            [['no_nota'], 'string', 'max' => 30],
            [['tujuan'], 'string', 'max' => 255],
            [['id_unit', 'id_nota'], 'unique', 'targetAttribute' => ['id_unit', 'id_nota']],
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
            'id_nota' => 'Id Nota',
            'no_nota' => 'Nomor Nota',
            'tgl_nota' => 'Tanggal Nota',
            'perihal' => 'Perihal',
            'tujuan' => 'Tujuan Nota',
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
