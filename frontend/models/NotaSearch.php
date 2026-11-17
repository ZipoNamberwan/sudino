<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Nota;
use common\models\User;

/**
 * NotaSearch represents the model behind the search form of `app\models\Nota`.
 */
class NotaSearch extends Nota
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_nota', 'no_nota', 'tgl_nota', 'perihal', 'tujuan','id_user'], 'safe'],
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
        $query = Nota::find()->innerJoinWith('user', true)->orderBy(['tgl_nota' => SORT_DESC,'CONVERT(id_nota, UNSIGNED INTEGER)' => SORT_DESC]);

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
            'tgl_nota' => $this->tgl_nota,
            //'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'id_unit', $this->id_unit])
            ->andFilterWhere(['like', 'id_nota', $this->id_nota])
            ->andFilterWhere(['like', 'no_nota', $this->no_nota])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'username', $this->id_user]);

        return $dataProvider;
    }
}
