<?php

namespace itzen\status\models;

use Yii;
use kartik\grid\GridView;
use yii\db\Query;
use yii\helpers\ArrayHelper;

use common\models\core\Category;
use common\models\core\Comment;


use common\models\core\Proxy;

use common\models\games\Company;
use common\models\games\Game;
use common\models\games\Genre;
use common\models\games\Language;
use common\models\games\MediaItem;
use common\models\games\Offer;
use common\models\games\Platform;
use yii\helpers\VarDumper;

/**
 * This is the model class for table "{{%core_status}}".
 *
 * @property integer $id
 * @property integer $sortorder
 * @property string $name
 * @property string $object_key
 *
 */
class Status extends \yii\db\ActiveRecord
{
    public $expandalbe = GridView::ROW_COLLAPSED;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%core_status}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sortorder'], 'required'],
            [['sortorder'], 'integer'],
            [['name'], 'string', 'max' => 45],
            [['object_key'], 'string', 'max' => 128],
            [['object_key'], 'default', 'value' => null]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'sortorder' => Yii::t('common', 'Sortorder'),
            'name' => Yii::t('common', 'Name'),
            'object_key' => Yii::t('common', 'Object Key'),
        ];
    }


    /**
     * @inheritdoc
     */
    public static function find($q = null)
    {
        return parent::find()->orderBy('sortorder asc');
    }

    public function beforeValidate()
    {
        if (parent::beforeValidate()) {
            if (!$this->sortorder) {
                $query = new Query();
                $max = $query->from('{{%core_status}}')->max('sortorder');
                $this->sortorder = $max + 1;
            }
            return true;
        } else {
            return false;
        }
    }

}
