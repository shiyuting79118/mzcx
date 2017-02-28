<?php

    namespace app\sms;

    class SmsSdk
    {
        public static function send($mobile, $code)
        {
            //todo...

            sleep(5);
            \Yii::error($mobile . ':' . $code);

            return true;
        }
    }
