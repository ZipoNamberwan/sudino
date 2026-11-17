<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Memo;
use common\models\User;

/**
 * MemoSearch represents the model behind the search form of `app\models\Memo`.
 */
class MemoSearch extends Memo
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id_unit', 'id_memo', 'no_memo', 'tgl_memo', 'perihal', 'tujuan','id_user'], 'safe'],
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
        $query = Memo::find()->innerJoinWith('user', true)->orderBy(['tgl_memo' => SORT_DESC,'CONVERT(id_memo, UNSIGNED INTEGER)' => SORT_DESC]);

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
            'tgl_memo' => $this->tgl_memo,
            //'id_user' => $this->id_user,
        ]);

        $query->andFilterWhere(['like', 'id_unit', $this->id_unit])
            ->andFilterWhere(['like', 'id_memo', $this->id_memo])
            ->andFilterWhere(['like', 'no_memo', $this->no_memo])
            ->andFilterWhere(['like', 'perihal', $this->perihal])
            ->andFilterWhere(['like', 'tujuan', $this->tujuan])
            ->andFilterWhere(['like', 'username', $this->id_user]);

        return $dataProvider;
    }
}
