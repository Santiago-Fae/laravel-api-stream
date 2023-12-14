<?php
namespace App\Filters\V1;

use Illuminate\Http\Request;
use App\Filters\ApiFilter;

class RatingFilter extends ApiFilter {
    protected $safePares = [
        'rating' => ['eq','lt','lte','gt','gte']
    ];

    protected $columnMap = [];
    protected $operatorMap = [
        'eq' => 'like',
        'lt' => '<',
        'lte' => '<=',
        'gt' => '>',
        'gte' => '>=',
    ];

    public function applyMovieFilter($ratings, $request)
    {
        if ($request->has('movie') && is_array($request->input('movie')) && $request->input('movie')['eq'] !== null) {
            $ratings->whereHas('movie', function ($query) use ($request) {
                $query->where('title', 'LIKE', '%' . $request->input('movie')['eq'] . '%');
            });
        }
    }
    public function applyUserFilter($ratings, $request)
    {
        if ($request->has('user') && is_array($request->input('user')) && $request->input('user')['eq'] !== null) {
            $ratings->whereHas('user', function ($query) use ($request) {
                $query->where('name', 'LIKE', '%' . $request->input('user')['eq'] . '%');
            });
        }
    }
}