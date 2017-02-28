<?php

namespace sonkei\status\behaviors;

use sonkei\status\models\Status;
use yii\base\Behavior;
use yii\base\InvalidConfigException;
use yii\db\ActiveRecord;

/**
 * Class StatusBehavior
 * @package sonkei\status\behaviors
 * @property ActiveRecord $owner
 */
class StatusBehavior extends Behavior
{
    #region Options
    /**
     * Status property name in owner model which holds status id.
     * @var string $statusColumn
     */
    public $statusColumn = 'status_id';
    /**
     * Key that uniquely identifies the model. Default to fully qualified class name of the model.
     * @var string $object_key
     */
    public $object_key;
    #endregion

    #region Core
    /** @inheritdoc */
    function events()
    {
        return [
            ActiveRecord::EVENT_INIT => 'onInit'
        ];
    }
    #endregion

    #region Events
    /**
     * Adds properties to model which are required by this behavior
     * @throws InvalidConfigException
     */
    function onInit()
    {
        if (!$this->object_key) {
            $this->object_key = get_class($this->owner);
        }
        if (!$this->owner->hasAttribute($this->statusColumn)) {
            throw new InvalidConfigException("Model {get_class($this->owner)} has not {$this->statusColumn} property. Set Behavior \$statusColumn to status column name.");
        }
    }
    #endregion

    #region Public methods
    /**
     * Add new status
     * @param Status $status
     * @return bool
     */
    function addStatus(Status $status)
    {
        $status->object_key = $this->object_key;
        return $status->save();
    }

    /**
     * @param $status_id
     * @return int
     */
    function saveStatus($status_id)
    {
        return $this->owner->updateAttributes([
            $this->statusColumn => $status_id
        ]);
    }

    /**
     * @param $status_id
     */
    function setStatus($status_id)
    {
        return $this->owner->setAttribute($this->statusColumn, $status_id);
    }
    #endregion
}
