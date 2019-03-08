<?php

require __DIR__.'/Operations/Basics/Point.php';
require __DIR__.'/Operations/Basics/Node.php';
require __DIR__.'/Operations/Basics/Search.php';

$parameters = json_decode(file_get_contents('php://input'), true);

$type = $parameters['type'] ?? 'BFS';
if (! isset($parameters['map']) || empty($parameters['map'])) {
    responseJson([], '参数错误', 400);
}

// TYPE 转换成响应的类名
$file = __DIR__."/Operations/{$type}.php";
if (! file_exists($file)) {
    responseJson([], "{$file} 不存在", 400);
}

require $file;
if (! class_exists($type)) {
    responseJson([], "{$type} 不存在", 400);
}


/**
 * @var $class Search
 */
$class = new $type(
    $parameters['map'],
    Point::mapNewInstance($parameters['start_point']),
    Point::mapNewInstance($parameters['end_point'])
);

$startTime = microtime(true);

$class->search($parameters['allow_angle'] ?? true);

$usedTime = microtime(true) - $startTime;

if ($class->find) {
    $find = '搜索成功';
} else {
    $find = '搜索失败';
}


$data = [
    'history' => $class->history,
    'short_path' => $class->shortestPath,
    'find' => $find,
    'used_time' => $usedTime
];

responseJson($data, "{$find}, 本次搜索用时 {$usedTime}");




function responseJson($data, $msg = 'success', $code = 200)
{
    header('Content-type: application/json');

    echo json_encode(compact('code', 'msg', 'data'), JSON_UNESCAPED_UNICODE);
    exit;
}
