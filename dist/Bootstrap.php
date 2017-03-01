<?php
/**
 * Created by PhpStorm.
 * User: Urmat
 * Date: 28.02.2017
 * Time: 15:04
 */

namespace sonkei\status;

use Yii;
use yii\base\Application;
use yii\base\BootstrapInterface;
use yii\web\GroupUrlRule;

/**
 * Class Bootstrap
 * @package sonkei\status
 */
class Bootstrap implements BootstrapInterface
{
    /** @inheritdoc */
    function bootstrap($app)
    {
        $this->registerI18N($app);

        $this->registerUrl($app);
    }

    /**
     * Register module's url rules
     * @param Application $app
     */
    protected function registerUrl($app)
    {
        $app->urlManager->addRules([Yii::createObject([
            'class' => GroupUrlRule::className(),
            'prefix' => 'status',
            'rules' => [
                '<a:\w+>' => 'status/<a>',
            ]
        ])], false);
    }

    /**
     * @param Application $app
     * @return array
     */
    protected function registerI18N($app)
    {
        return $app->i18n->translations['status/*'] = [
            'class' => 'yii\i18n\PhpMessageSource',
            'basePath' => '@sonkei/status/messages',
        ];
    }
}