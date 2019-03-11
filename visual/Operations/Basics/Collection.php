<?php

class Collection implements JsonSerializable
{
    protected $items;

    public function __construct($items = [])
    {
        if (! is_array($items)) {
            $items = func_get_args();
        }

        $this->items = $items;
    }


    public function isNotEmpty()
    {
        return ! empty($this->items);
    }

    public function pop()
    {
        return array_pop($this->items);
    }

    public function shift()
    {
        return array_shift($this->items);
    }

    public function each(callable $callback)
    {
        foreach ($this->items as $key => $item) {
            if ($callback($item, $key) === false) {
                break;
            }
        }

        return $this;
    }

    public function remember($key, $value)
    {
        if (! $this->has($key)) {

            $this->items[$key] = $value;
        }

        return $this->items[$key];
    }

    public function put($key, $value)
    {
        $this->items[$key] = $value;
        return $this;
    }

    public function get($key, $default = null)
    {
        if (! $this->has($key)) {

            return $default;
        }

        return $this->items[$key];
    }

    public function has($key)
    {
        return array_key_exists($key, $this->items);
    }

    public function push($value)
    {
        $this->items[] = $value;

        return $this;
    }


    public function merge(array $items)
    {
        $this->items = array_merge($this->items, $items);

        return $this;
    }

    public function jsonSerialize()
    {
        return $this->items;
    }
}
