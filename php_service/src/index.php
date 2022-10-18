<?php


require '../vendor/autoload.php';

$router = new \Bramus\Router\Router();

$router->get("/",function (){
    require "./templates/home.php";
});

$router->post("/log-grpc",function (){
    $json_string_data = file_get_contents('php://input');
    $decoded_data = json_decode($json_string_data, true);


    $client = new \App\Proto\LogServiceClient('log-service:50051',[
        'credentials' => \Grpc\ChannelCredentials::createInsecure(),
    ]);

    $log = new \App\Proto\Log();
    $log->setLevel($decoded_data['level']);
    $log->setMessage($decoded_data['message']);
    $log->setData($decoded_data['data']);

    $logRequest = new \App\Proto\LogRequest();
    $logRequest->setLogEntry($log);

    list($response, $status) = $client->WriteLog($logRequest)->wait();

    header('Content-Type: application/json');
    $jsonArray = array();
    $jsonArray['error'] = false;
    $jsonArray['message'] = $response->getResult();

    echo json_encode($jsonArray);
});

$router->run();
