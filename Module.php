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
    public $translateCategory = 'common';

    /**
     * @inheritdoc
     */
    public function init() {
        parent::init();
        if (!isset(Yii::$app->i18n->translations['itzen']) || !isset(Yii::$app->i18n->translations['*'])) {
            Yii::$app->i18n->translations['itzen'] = [
                'class' => 'yii\i18n\PhpMessageSource',
                'sourceLanguage' => 'en',
                'basePath' => '@itzen/status/messages'
            ];
        }
    }


}
