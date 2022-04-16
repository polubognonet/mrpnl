<?php


/**
 * @author lin <465382251@qq.com>
 *
 * Fill in your key and secret and pass can be directly run
 *
 * Most of them are unfinished and need your help
 * https://github.com/zhouaini528/huobi-php.git
 * */
use Lin\Binance\BinanceFuture;

require __DIR__ .'../../../vendor/autoload.php';

include 'key_secret.php';

$binance=new BinanceFuture($key,$secret);

$binance->setOptions([
    //Set the request timeout to 60 seconds by default
    'timeout'=>10,

    //https://github.com/guzzle/guzzle
    'proxy'=>[],

    //https://www.php.net/manual/en/book.curl.php
    'curl'=>[],

    //default is v1
    //'version'=>'v1',
]);

//Send in a new order.
try {
    $result=$binance->trade()->postOrder([
        'symbol'=>'BTCUSDT',
        'side'=>'BUY',
        'type'=>'LIMIT',
        'quantity'=>'1',
        'price'=>'60000',
        'timeInForce'=>'GTC',
        //'newClientOrderId'=>'xxxxxxx'
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
sleep(1);

try {
    $result=$binance->trade()->postBatchOrders([
        'batchOrders'=>[
            [
                'symbol'=>'BTCUSDT',
                'side'=>'BUY',
                'type'=>'LIMIT',
                'quantity'=>'1',
                'price'=>'60000',
                'timeInForce'=>'GTC',
                //'newClientOrderId'=>'xxxxxxx'
            ],
            [
                'symbol'=>'BTCUSDT',
                'side'=>'BUY',
                'type'=>'LIMIT',
                'quantity'=>'2',
                'price'=>'60000',
                'timeInForce'=>'GTC',
                //'newClientOrderId'=>'xxxxxxx'
            ],
        ]
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
sleep(1);
die;


//Check an order's status.
try {
    $result=$binance->user()->getOrder([
        'symbol'=>'BTCUSDT',
        'orderId'=>$result['orderId'],
        //'origClientOrderId'=>$result['clientOrderId'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}
sleep(1);

//Cancel an active order.
try {
    $result=$binance->trade()->deleteOrder([
        'symbol'=>'BTCUSDT',
        'orderId'=>$result['orderId'],
        'origClientOrderId'=>$result['clientOrderId'],
    ]);
    print_r($result);
}catch (\Exception $e){
    print_r($e->getMessage());
}







