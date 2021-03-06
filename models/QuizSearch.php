<?php

namespace app\models;

use app\models\Quiz;
use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use yii\widgets\Pjax;


/**
 * QuizSearch represents the model behind the search form of `app\models\Quiz`.
 */
class QuizSearch extends Quiz
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'min_correct', 'updated_at', 'max_question'], 'integer'],
            [['created_by', 'updated_by'], 'string'],
            [['subject'], 'safe'],
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
    public function search($params)
    {
        $query = Quiz::find();
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
            'min_correct' => $this->min_correct,
            'updated_at' => $this->updated_at,
            'max_question' => $this->max_question,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

        $query->andFilterWhere(['like', 'subject', $this->subject]);

        return $dataProvider;
    }


}
