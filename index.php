<?php

require __DIR__.'/vendor/autoload.php';

try {
    $builder = new DI\ContainerBuilder();
    $container = $builder->build();
    $requestFactory = $container->get(\App\System\RequestFactory::class);
    $responseFactory = $container->get(\App\System\ResponseFactory::class);
    $request = $requestFactory->create(
        $_SERVER['PATH_INFO'] ?? $_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD'],
        !empty($_GET) ? $_GET: json_decode(file_get_contents('php://input'), true),
        !empty($_POST) ? $_POST: json_decode(file_get_contents('php://input'), true)
    );

    $response = $responseFactory->create($request);
} catch (\Throwable $t) {
    var_dump($t); die;
}
http_response_code($response->getCode());
header('Content-Type: application/json');
echo $response->getBody();