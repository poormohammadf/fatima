<?php
/**
 * Created by PhpStorm.
 * User: FATIMA
 * Date: 2/4/2016
 * Time: 4:04 PM
 */

require('lib.php');
define('WEBHOOK_URL', 'https://my-site.example.com/secret-path-for-webhooks/');
apiRequest('setWebhook', array('url' =>  WEBHOOK_URL));