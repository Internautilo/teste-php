<?php

namespace Database\Interfaces;

interface DatabaseRetriever
{
    public function fetchAll(string $table): array;
    public function findOne(string $table, array $where): array;
}
