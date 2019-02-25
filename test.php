<?php

(new Application(__DIR__))->run();


class Application
{
    protected $basePath;
    protected $offsetIndex = 0;
    protected $tableText;

    public function __construct($basePath = null)
    {
        $this->basePath = realpath($basePath) ?: __DIR__;
    }

    public function run()
    {
        $allTestFiles = $this->getAllTestFiles($this->basePath, false);

        foreach ($allTestFiles as $item) {

            list($paramNames, $paramValues, $expectOutput) = require $item['file'];

            // 第一个是类名
            array_shift($expectOutput);
            $object = $this->newClass($item['namespace'], $className = array_shift($paramNames), array_shift($paramValues));

            // 绘制输出
            $this->drawTableHeader($className);

            foreach ($paramNames as $key => $methodName) {

                $return = $object->$methodName(...$paramValues[$key]);

                // 绘制表格消息
                $this->drawTableBody($methodName, $paramValues[$key], $expectOutput[$key], $return);
            }

            $this->outputTable();
        }
    }

    protected function newClass($namespace, $class, $parameters = [])
    {
        $fullClass = $namespace . '\\' . $class;

        if (! class_exists($fullClass)) {
            $this->dd("{$fullClass} class not exists");
        }

        return new $fullClass(...$parameters);
    }


    protected function getAllTestFiles($directory, $isSave = true)
    {
        $files = [];

        if($handle = opendir($directory)) {

            while(($filename = readdir($handle)) !== false) {

                // . 开头的文件都不要遍历
                if($filename{0} === '.') {
                    continue;
                }

                $file = $directory . '/' . $filename;

                if (is_file($file)) {

                    if ($isSave && strpos($filename, '.php') !== false) {

                        $namespace = str_replace(
                            [$this->basePath, '/'],
                            ['', '\\'],
                            $directory
                        );

                        $files[] = compact('file', 'namespace');
                    }

                    continue;
                }

                $files = array_merge($files, $this->getAllTestFiles($file));
            }

            closedir($handle);
        }

        return $files;
    }

    protected function drawTableHeader($className)
    {
        $this->tableText = <<<table
----------------------------------------
|    {$className}
----------------------------------------
table;

    }

    protected function drawTableBody($method, $parameter, $expectOutput, $return = null)
    {
        $parameter = '(' . implode(', ', $parameter) . ')';

        if (is_null($expectOutput)) {
            $expectOutput = 'null';
        }

        if (is_null($return)) {
            $return = 'null';
        }

        $this->tableText .= <<<table
        
|    method    {$method}
|    input     {$parameter}
|    expect    {$expectOutput}
|    output    {$return}
----------------------------------------
table;

    }

    protected function outputTable()
    {
        echo $this->tableText;
        echo PHP_EOL;
    }

    protected function dd()
    {
        foreach (func_get_args() as $arg) {

            if (is_int($arg) || is_string($arg)) {
                echo $arg;
                continue;
            }

            var_dump($arg);
        }
        exit;
    }
}
