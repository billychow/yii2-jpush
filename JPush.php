<?php
namespace billychow\jpush;

use yii\base\Component;
use yii\base\InvalidConfigException;

class JPush extends Component
{
    public $appKey;
    public $appSecret;
    private $jPush;


    public function init()
    {
        parent::init();
        if(empty($this->appKey) || empty($this->appSecret)) {
            throw new InvalidConfigException("appKey and appSecret cannot be empty!");
        }

        $this->jPush = new \JPush($this->appKey, $this->appSecret, \Yii::getAlias('@runtime/logs/jpush.log'));
    }

    public function __call($method, $args = [])
    {
        return call_user_func_array(array($this->jPush, $method), $args);
    }
}