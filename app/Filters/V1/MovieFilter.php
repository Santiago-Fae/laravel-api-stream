<?php
namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class MovieFilter extends ApiFilter {
    protected $safePares = [
        'title' => ['eq'],
        'releaseDate' => ['eq','lt','lte','gt','gte']
    ];

    protected $columnMap = [
        'releaseDate' => 'release_date'
    ];
    protected $operatorMap = [
        'eq' => 'like',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

    public function applyGenreFilter($movies, $request)
    {
        if ($request->has('genre') && $request->input('genre') !== null) {
            $movies->whereHas('genre', function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->input('genre') . '%');            });
        }

    }
}