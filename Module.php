<?php

namespace itzen\status;

use Yii;

class Module extends \yii\base\Module {

    /**
     * @inheritdoc
     */
    public $defaultRoute = 'status';

    /**
     * @inheritdoc
     */
    public $controllerNamespace = 'itzen\status\controllers';

    /**
     * @var string
     * Translate category used in Yii::t() function
     */
    public static $translateCategory = 'common';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        if (!isset(Yii::$app->i18n->translations[self::$translateCategory]) && !isset(Yii::$app->i18n->translations['*'])) {
            Yii::$app->i18n->translations[self::$translateCategory] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => '@itzen/status/messages'
            ];
        }
    }


}
