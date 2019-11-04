<?php

namespace app\models;

use app\models\Answer;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * AnswerSearch represents the model behind the search form of `app\models\Answer`.
 */
class AnswerSearch extends Answer
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'question_id', 'is_correct'], 'integer'],
            [['name'], 'safe'],
            [['created_at', 'updated_at'], 'safe'],
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
    public function search($params, $id)
    {
        $query = Answer::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if ($this->created_at) {

            $query->andFilterWhere([
                'FROM_UNIXTIME (created_at, "%Y-%m-%d")' => $this->created_at
            ]);

        }
        if ($this->updated_at) {
            $query->andFilterWhere([
                'FROM_UNIXTIME (updated_at, "%Y-%m-%d")' => $this->updated_at
            ]);
        }

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'question_id' => $id,
            'is_correct' => $this->is_correct,

        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }


}
