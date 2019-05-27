<?php
namespace app\interfaces;

interface SearchAlgo
{
    public function auto_complete($data);

    public function filter($filters, $page);
}