<?php

namespace app\models;

use app\models\Result;
use yii\base\Model;
use yii\data\ActiveDataProvider;


/**
 * QuestionSearch represents the model behind the search form of `app\models\Question`.
 */
class ResultSearch extends Result
{
    /**
     * {@inheritdoc}
     */
    public function getNext()
    {

    }

    public function rules()
    {
        return [
            [['quiz_id', 'min_correct', 'correct_answer_count', 'number_of_questions', 'quiz_pass_date', 'created_by', 'updated_by'], 'integer'],
            [['quiz_name'], 'string', 'max' => 255],
            [['quiz_id'], 'exist', 'skipOnError' => true, 'targetClass' => Quiz::className(), 'targetAttribute' => ['quiz_id' => 'id']],
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
        $query = Result::find();

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
            'id' => $this->id,
            'quiz_id' => $this->quiz_id,
            'min_correct' => $this->min_correct,
            'correct_answer_count' => $this->correct_answer_count,
            'number_of_questions' => $this->number_of_questions,
            'quiz_pass_date' => $this->quiz_pass_date,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
        ]);

//        $query->andFilterWhere(['like', 'name', $this->name])
//            ->andFilterWhere(['like', 'hint', $this->hint]);

        return $dataProvider;
    }

}