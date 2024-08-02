<?php 
namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\DB;

class UniqueUpdateInConnection implements Rule
{
    protected $table;
    protected $column;
    protected $connection;
    protected $ignoreId;

    public function __construct($table, $column, $connection, $ignoreId = null)
    {
        $this->table = $table;
        $this->column = $column;
        $this->connection = $connection;
        $this->ignoreId = $ignoreId;
    }

    public function passes($attribute, $value)
    {
        $query = DB::connection($this->connection)
            ->table($this->table)
            ->where($this->column, $value);

        if ($this->ignoreId) {
            $query->where('id', '<>', $this->ignoreId);
        }

        return $query->count() === 0;
    }

    public function message()
    {
        return 'The : nama tersebut sudah sudah ada di sistem.';
    }
}