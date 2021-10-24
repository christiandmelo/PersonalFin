<?php

namespace App\Helper;

interface EntityFactoryInterface
{
    public function createEntity(string $json, int $userId, bool $insert);
}
