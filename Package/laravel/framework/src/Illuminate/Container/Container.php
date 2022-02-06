<?php


namespace Illuminate\Container;

use ReflectionClass;


class Container
{
    /**
     * 生產實例
     */
    public function make($abstract)
    {
        return $this->resolve($abstract);
    }
    /**
     * 解析實例
     */
    protected function resolve($abstract)
    {
        $concrete = $abstract;
        $object = $this->build($concrete);
        return $object;
    }
    /**
     * 構建實例
     */
    public function build($concrete)
    {
        $reflector = new ReflectionClass($concrete);
        // 獲取建構子
        $constructor = $reflector->getConstructor();
        if (is_null($constructor)) {
            return new $concrete;
        }
        // 獲取依賴
        $dependencies = $constructor->getParameters();
        // 解析依賴
        $instances = $this->resolveDependencies($dependencies);
        // 給定參數創建一個新的class實例
        return $reflector->newInstanceArgs($instances);
    }
    /**
     * 解析依賴
     */
    protected function resolveDependencies(array $dependencies)
    {
        $results = [];

        foreach ($dependencies as $dependency) {
            $results[] = $this->make($dependency->getName());
        }
        return $results;
    }
}
