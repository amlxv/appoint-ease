<?php

namespace App\View\Components\Tables;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Str;
use Illuminate\View\Component;

class UserTable extends Component
{
    const REQUIRED_KEYS = ['users', 'route', 'columns'];

    /**
     * Create a new component instance.
     */
    public function __construct(
        public array $tableData,

    )
    {
        $this->validateTableData();
        $this->validateColumns();
    }

    /**
     * Validate the component's required data.
     *
     * @return void
     */
    private function validateTableData(): void
    {
        foreach (self::REQUIRED_KEYS as $key) {
            if (!array_key_exists($key, $this->tableData)) {
                abort(500, Str::title($key) . ' is not defined');
            }
        }
    }

    /**
     * Validate first and last element in Columns array
     *
     * @return void
     */
    private function validateColumns(): void
    {
        $columns = $this->tableData['columns'];

        $first = array_key_first($columns);
        $last = array_key_last($columns);

        if ($first !== 'Name' || $last !== 'Action') {
            abort(500, 'Columns array must start with Name and end with Action');
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.tables.user-table');
    }
}
