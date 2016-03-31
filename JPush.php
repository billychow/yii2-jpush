<?php
namespace billychow\jpush;
use yii\base\Component;
use yii\base\InvalidConfigException;

class Jpush extends Component
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
        $this->jPush = new \jpush\jpush\JPush($this->appKey, $this->appSecret);
    }

    public function __call($method, $args = [])
    {
        return call_user_func_array(array($this->jPush, $method), $args);
    }
}