<?php

namespace App\Storage;

interface ShelfInterface
{
    public function take(string $id);

    public function takeOneBy(string $field, $value, string $operator = null);

    public function takeAll();

    public function add($object);

    public function remove($object);
}