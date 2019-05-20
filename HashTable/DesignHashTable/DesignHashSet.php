<?php

namespace QueueAndStack\QueueFirstInFirstOut\DesignHashSet;

class MyHashSet
{
    protected $size = 9;
    protected $data;

    public function __construct()
    {
        $this->data = array_fill(0, $this->size - 1, []);
    }

    /**
     * @param Integer $key
     * @return NULL
     */
    public function add($key)
    {
        if ($this->contains($key)) {
            return;
        }

        $hashKey = $this->hashKey($key);
        $collection = &$this->data[$hashKey];
        $collection[] = $key;
    }

    /**
     * @param Integer $key
     * @return NULL
     */
    public function remove($key)
    {
        if (! $this->contains($key)) {
            return;
        }


        $hashKey = $this->hashKey($key);
        $collection = &$this->data[$hashKey];

        for ($i = 0, $l = count($collection); $i < $l; ++ $i) {

            if ($collection[$i] === $key) {

                unset($collection[$i]);
                $collection = array_values($collection);
                return;
            }
        }

    }

    /**
     * Returns true if this set contains the specified element
     *
     * @param Integer $key
     * @return Boolean
     */
    public function contains($key)
    {
        $collection = $this->data[$this->hashKey($key)];

        for ($i = 0, $l = count($collection); $i < $l; ++ $i) {

            if ($collection[$i] === $key) {

                return true;
            }
        }

        return false;
    }

    protected function hashKey($key)
    {
        return $key % $this->size;
    }
}
