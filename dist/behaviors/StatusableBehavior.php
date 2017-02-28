<?php

namespace sonkei\status\behaviors;

use sonkei\status\models\Status;
use sonkei\status\Module as StatusModule;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

/**
 * Class StatusableBehavior
 * @property ActiveRecord $owner
 * @package sonkei\status\behaviors
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
            ActiveRecord::EVENT_INIT => 'onInit'
        ];
    }

    /**
     * Adds properties to model which are required by this behavior
     */
    public function onInit()
    {
        if (!$this->object_key) {
            $this->object_key = get_class($this->owner);
        }
        if (!$this->owner->hasAttribute($this->statusColumn)) {

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
            return false;
        }
    }

    public function getAvailableStatuses($translate = true)
    {
        $statuses = Status::find()->where(
            ['or', 'object_key IS NULL', 'object_key=:object_key']
        )->params([':object_key' => $this->object_key])->all();

        if ($translate) {
            foreach ($statuses as $key => $status) {
                $statuses[$key]->name = StatusModule::t('core', $status->name);
            }

        }
        return $statuses;
    }

    public function getAvailableStatusesForKey($translate = true)
    {
        $statuses = Status::find()->where(['object_key' => $this->object_key])->all();

        if ($translate) {
            foreach ($statuses as $key => $status) {
                $statuses[$key]->name = StatusModule::t('core', $status->name);
            }

        }
        return $statuses;
    }

    public function getStatus($translate = true)
    {
        $status = Status::findOne(['id' => $this->owner->{$this->statusColumn}]);
        if ($translate) {
            $status->name = StatusModule::t('core', $status->name);
        }
        return $status;
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
