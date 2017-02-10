<?php

namespace App\Http\Controllers\Api;

use Response;
use Illuminate\Http\Request;
use StdClass;

class CompassController extends ApiController
{
    public function __construct(Request $request) {
        parent::__construct($request);
    }

    public function index($code) {
        include_once realpath(dirname(__FILE__).'/../../../../').'/vendor/wechat/wxBizDataCrypt.php';

        $data = array();

        $appid = 'wxa4d95c5d0c55d32d';
        $appsecret = '8eac3d582dd0ed634a4f92fed39e98f1';
        $wxApi = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$appsecret.'&js_code='.$code.'&grant_type=authorization_code';

        $ch = curl_init();
        curl_setopt_array($ch, array(
            CURLOPT_URL            => $wxApi,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_HEADER         => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_SSL_VERIFYHOST => false,
            CURLOPT_TIMEOUT        => 15,
        ));
        $response = curl_exec($ch);
        curl_close($ch);

        @ob_end_clean();

        $data = json_decode($response, true);
        $data['session_id'] = md5(uniqid(rand(), true));

        if (isset($data['session_key'])) {
            unset($data['session_key']);
        }

        if (isset($data['expires_in'])) {
            unset($data['expires_in']);
        }

        return $this->jsonResult($data);
    }

    public function upload($sessionId) {
        $data = new StdClass;

        $file = $_FILES['photo'];
        $openid = $_GET['openid'];

        $savePath = realpath(dirname(__FILE__).'/../../../../storage/app/public/');
        $saveFile = $savePath . '/' . $sessionId . '.jpg';

        move_uploaded_file($file['tmp_name'], $saveFile);

        return $this->jsonResult($data);
    }

    public function report($sessionId) {
        $data = array(
            'skinAge' => rand(28, 42),
            'scale' => 3.1793343268753103,
            'updatedAt' => '2017-01-22T11:56:45.8481185',
            'zones' => array(
                array(
                    'zone' => 'nasolabial_mouth',
                    'weight' => '0.1'.rand(10, 90).'14209860285217',
                    'centers' => array(
                        array(190, 287),
                        array(225, 284)
                    ),
                    'scaledCenters' => array(
                        array(272, 513),
                        array(383, 504)
                    )
                ),
                array(
                    'zone' => 'undereye',
                    'weight' => '0.1'.rand(10, 90).'14209860285217',
                    'centers' => array(
                        array(190, 287),
                        array(225, 284)
                    ),
                    'scaledCenters' => array(
                        array(272, 513),
                        array(383, 504)
                    )
                ),
                array(
                    'zone' => 'cheek',
                    'weight' => '0.1'.rand(10, 90).'14209860285217',
                    'centers' => array(
                        array(190, 287),
                        array(225, 284)
                    ),
                    'scaledCenters' => array(
                        array(272, 513),
                        array(383, 504)
                    )
                ),
                array(
                    'zone' => 'crowsfeet',
                    'weight' => '0.1'.rand(10, 90).'14209860285217',
                    'centers' => array(
                        array(190, 287),
                        array(225, 284)
                    ),
                    'scaledCenters' => array(
                        array(272, 513),
                        array(383, 504)
                    )
                ),
                array(
                    'zone' => 'forehead',
                    'weight' => '0.1'.rand(10, 90).'14209860285217',
                    'centers' => array(
                        array(190, 287),
                        array(225, 284)
                    ),
                    'scaledCenters' => array(
                        array(272, 513),
                        array(383, 504)
                    )
                )
            ),
        );

        return $this->jsonResult($data);
    }

    public function products($sessionId) {
        $data = array();

        return $this->jsonResult($data);
    }

}
