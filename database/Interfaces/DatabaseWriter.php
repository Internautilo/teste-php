<?php

namespace Database\Interfaces;

interface DatabaseWriter
{
    public function insert(array $data, string $intoTable): int;
    public function update(array $data, array $where, string $table): int;
    public function delete(string $table, array $where): int;
}
