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

        foreach ($allTestFiles as $fullPath) {

            // 1. 先拿到当前测试的代码
            // 2. 生成一个随机的命名空间
            // 3. 因为 eval 不解析 <?php, 直接替换成随机命名空间
            $currTestCode = file_get_contents($fullPath);
            $namespace = $this->getNamespace();
            $currTestCode = str_replace('<?php', "namespace {$namespace};", $currTestCode);

            // 第一个是所有参数, 第二个是测试的数据
            list($paramNames, $paramValues) = eval($currTestCode);
            // 第一个是类名
            $object = $this->newClass($namespace, $className = array_shift($paramNames), array_shift($paramValues));

            // 绘制输出
            $this->drawTableHeader($className);

            foreach ($paramNames as $key => $methodName) {

                $return = $object->$methodName(...$paramValues[$key]);

                // 绘制表格消息
                $this->drawTableBody($methodName, $paramValues[$key], $return);
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

    protected function  getNamespace()
    {
        $namespace = 'A';

        return $namespace . $this->offsetIndex ++;
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

                $fullName = $directory . '/' . $filename;

                if (is_file($fullName)) {

                    if ($isSave && strpos($filename, '.php') !== false) {

                        $files[] = $fullName;
                    }

                    continue;
                }

                $files = array_merge($files, $this->getAllTestFiles($fullName));
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

    protected function drawTableBody($method, $parameter, $return = null)
    {
        $parameter = '(' . implode(', ', $parameter) . ')';

        $this->tableText .= <<<table
        
|    method    {$method}
|    input     {$parameter}
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
