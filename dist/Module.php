<?php

namespace sonkei\status;

use Yii;
use yii\base\Module as BaseModule;

/**
 * Class Module
 * @package sonkei\status
 */
class Module extends BaseModule
{
    #region Core
    /** @inheritdoc */
    public $defaultRoute = 'status';

    public $defaultIds = [];
    #endregion

    #region Public methods
    /**
     * Translates a message to the specified language.
     * For more information @see Yii::t()
     * @param string $parameter the message parameter.
     * @param string $message the message to be translated.
     * @param array $params the parameters that will be used to replace the corresponding placeholders in the message.
     * @param string|null $language the language code (e.g. `en-US`, `en`). If this is null, the current
     * @return string the translated message.
     */
    static function t($parameter, $message, array $params = [], $language = null)
    {
        return Yii::t('status/' . $parameter, $message, $params, $language);
    }
    #endregion
}
