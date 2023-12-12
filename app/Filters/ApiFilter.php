<?php
namespace App\Filters;

use Illuminate\Http\Request;

class ApiFilter {
    protected $safePares = [];

    protected $columnMap = [];
    
    protected $operatorMap = [
        'eq' => '=',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];
        
    public function transform(Request $request)
    {
        $eloQuery = [];

        foreach ($this->safePares as $parm => $operators) {

            $query = $request->query($parm);

            if (!isset($query)) {
                continue;
            }

            $column = $this->columnMap[$parm] ?? $parm;

            foreach ($operators as $operator) {
                if (isset($query[$operator])) {
                    if ($operator === 'eq') {
                        $eloQuery[] = [$column, 'like', '%' . $query[$operator] . '%'];
                    } else {
                        $eloQuery[] = [$column, $this->operatorMap[$operator],  $query[$operator]];
                    }
                }
            }
        }
        return $eloQuery;
    }
}