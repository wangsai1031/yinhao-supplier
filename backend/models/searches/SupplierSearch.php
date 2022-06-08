<?php

namespace backend\models\searches;

use common\traits\EnumTrait;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Supplier;

/**
 * SupplierSearch represents the model behind the search form of `backend\models\Supplier`.
 */
class SupplierSearch extends Supplier
{
    use EnumTrait;

    const GT = '>',
        GTE = '>=',
        LT = '<',
        LTE = '<=';

    public $id_operator;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'code', 't_status', 'id_operator'], 'safe'],
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
        $query = Supplier::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => [
                'pageSize' => 10
            ]
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        if ($this->id !== null) {
            switch ($this->id_operator) {
                case static::GT:
                    $query->andWhere(['>', 'id', $this->id]);
                    break;
                case static::GTE:
                    $query->andWhere(['>=', 'id', $this->id]);
                    break;
                case static::LT:
                    $query->andWhere(['<', 'id', $this->id]);
                    break;
                case static::LTE:
                    $query->andWhere(['<=', 'id', $this->id]);
                    break;
            }
        }

        // grid filtering conditions
        $query->andFilterWhere([
            't_status' => $this->t_status,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code]);

        return $dataProvider;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        $parent = parent::attributeLabels();
        $parent['id_operator'] = 'id_operator';

        return $parent;
    }

    public static function getEnumData()
    {
        return [
            'id_operator' => [
                static::GT => static::GT,
                static::LT => static::LT,
                static::GTE => static::GTE,
                static::LTE => static::LTE,
            ]
        ];
    }
}
