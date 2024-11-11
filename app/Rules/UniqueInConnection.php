<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueInConnection implements Rule
{
    protected $table;
    protected $column;
    protected $connection;

    public function __construct($table, $column, $connection)
    {
        $this->table = $table;
        $this->column = $column;
        $this->connection = $connection;
    }

    public function passes($attribute, $value)
    {
        return !DB::connection($this->connection)
            ->table($this->table)
            ->where($this->column, $value)
            ->exists();
    }

    public function message()
    {
        return 'Data tersebut sudah ada di sistem.';
    }
}
