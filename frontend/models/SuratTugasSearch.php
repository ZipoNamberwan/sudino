<?php

namespace app\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SuratTugas;
use common\models\User;

/**
 * SuratTugasSearch represents the model behind the search form of `app\models\SuratTugas`.
 */
class SuratTugasSearch extends SuratTugas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_surat', 'no_surat', 'tgl_surat', 'perihal','tujuan','id_user'], 'safe'],
            //[['id_user'], 'integer'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = SuratTugas::find()->innerJoinWith('user', true)->orderBy(['tgl_surat' => SORT_DESC,'CONVERT(id_surat, UNSIGNED INTEGER)' => SORT_DESC]);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'tgl_surat' => $this->tgl_surat,
            //'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'id_unit', $this->id_unit])
            ->andFilterWhere(['like', 'id_surat', $this->id_surat])
            ->andFilterWhere(['like', 'no_surat', $this->no_surat])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'username', $this->id_user]);

        return $dataProvider;
    }
}
