<?php
namespace common\components;

use Yii;
use yii\base\Component;

class WeChatSendMsg extends Component
{
    public $app_id;
    public $app_secret;

    public function sendWeChatMsg($msg)
    {
        $post_data = [
            'touser' => "@all",
            'toparty' => '',
            'totag' => '',
            'msgtype' => 'text',
            'agentid' => '1000002',
            'safe' => '0',
            'text' => [
                'content' => $msg,
            ],
        ];
        $token = $this->getAccessToken();
        $url = "https://qyapi.weixin.qq.com/cgi-bin/message/send?access_token={$token}";

        return $this->curlPost($url,$post_data);
    }

    function getAccessToken() {
        $cache = Yii::$app->cache;

        if (!empty($data = $cache->get('wechat_access_token'))) {
            $data = json_decode($data);
        }

        if (empty($data) && $data["expire_time"] < time()) {
            $url = "https://qyapi.weixin.qq.com/cgi-bin/gettoken?corpid={$this->app_id}&corpsecret={$this->app_secret}";
            $res = json_decode($this->curlGet($url),true);
            $access_token = $res['access_token'];
            if ($access_token) {
                $data['expire_time'] = time() + 7000;
                $data['access_token'] = $access_token;

                $cache->set('wechat_access_token', json_encode($data));
            }
        } else {
            $access_token = $data['access_token'];
        }
        return $access_token;
    }

    public function curlGet($url)
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);

        $output = curl_exec($ch);
        curl_close($ch);

        return $output;
    }

    public function curlPost($url, $post_data)
    {
        $data_string = json_encode($post_data);
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string)]
        );

        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }
}