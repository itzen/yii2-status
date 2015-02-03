<?php

namespace itzen\comments\behaviors;

use Closure;
use itzen\status\models\Status;
use Yii;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;
use yii\helpers\ArrayHelper;

/**
 * Class StatusableBehavior
 * @property ActiveRecord $owner
 * @package itzen\status\behaviors
 */
class StatusableBehavior extends Behavior
{
    /**
     * Status property name in owner model which holds status id.
     * @var string
     */
    public $statusColumn = 'status_id';


    /**
     * @var string
     * Key that uniquely identifies the model. Default to fully qualified class name of the model.
     */
    public $object_key;


    /**
     * @return array
     */
    public function events()
    {
        return [
            ActiveRecord::EVENT_AFTER_FIND => 'afterFind'
        ];
    }

    /**
     * Adds properties to model which are required by this behavior
     */
    public function afterFind()
    {
        if (!$this->object_key) {
            $this->object_key = get_class($this->owner);
        }
        if (!$this->owner->hasProperty($this->statusColumn)) {
            throw new InvalidConfigException("Model {get_class($this->owner)} has not {$this->statusColumn} property. Set Behavior \$statusColumn to status column name.");
        }
    }

    /**
     * @param Status $status
     * @return bool
     */
    public function addStatus(Status $status)
    {
        $status->object_key = $this->object_key;
        if ($status->save()) {
            return true;
        } else {
            return $status->getErrors();
        }
    }

    public function getAvailableStatuses()
    {
        $searchModel = new \itzen\status\models\search\Status();

        $dataProvider = $searchModel->searchForModel($this->object_key);

        return [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider
        ];
    }

    public function getStatus()
    {
        Status::findOne(['id' => $this->{$this->statusColumn}]);
    }

    public function saveStatus($status_id)
    {
        $this->owner->{$this->statusColumn} = $status_id;
        if ($this->owner->save()) {
            return true;
        } else {
            return false;
        }
    }

    public function setStatus($status_id)
    {
        $this->owner->{$this->statusColumn} = $status_id;
    }


}
