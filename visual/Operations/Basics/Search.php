<?php

class Search
{
    protected $map;
    protected $start;
    protected $end;
    protected $visited = [];
    const WALL = '1';
    const BLACK = '0';

    public $history = [];

    public function __construct(array $map, Point $start, Point $end)
    {
        $this->visited = $this->map = $map;
        $this->start = $start;
        $this->end= $end;
    }

    public function search()
    {
        return true;
    }

}
