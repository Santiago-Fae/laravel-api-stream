<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Rating;
use App\Http\Requests\V1\StoreRatingRequest;
use App\Http\Requests\V1\UpdateRatingRequest;
use App\Http\Resources\V1\RatingResource;
use App\Http\Resources\V1\RatingCollection;
use App\Filters\V1\RatingFilter;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     */
    public function index(Request $request)
    {
        $filter = new RatingFilter();
        $queryItems = $filter->transform($request);

        $ratings = Rating::where($queryItems);

        if ($request->has('movie')) {
            $filter->applyMovieFilter($ratings, $request);
            $ratings->with('movie');
        }

        if ($request->has('user')) {
            $filter->applyUserFilter($ratings, $request);
            $ratings->with('user');
        }

        return new RatingCollection($ratings->paginate()->appends($request->query()));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreRatingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreRatingRequest $request)
    {
        $existingRating = Rating::where('id_movie', $request->id_movie)
                                ->where('id_user', $request->id_user)
                                ->first();
        // Rating already exists
        if ($existingRating) {
            return response()->json(['error' => 'This user has already given a review to this film'], 409);
        }

        return new RatingResource(Rating::create($request->all()));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rating  $Rating
     * @return \Illuminate\Http\Response
     */
    public function show(Rating $Rating)
    {
        return new RatingResource($Rating->loadMissing(['movie', 'user']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rating  $Rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $Rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateRatingRequest  $request
     * @param  \App\Models\Rating  $Rating
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRatingRequest $request, $ratingId)
    {
        if (!Rating::where('id', $ratingId)->exists()) {
            return response()->json(['error' => 'Rating not found'], 404);
        }

        $rating = Rating::find($ratingId);
        $rating->update($request->all());

        return new RatingResource($rating);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rating  $Rating
     * @return \Illuminate\Http\Response
     */    
    public function destroy($ratingId)
    {
        $rating = Rating::find($ratingId);

        if (!$rating) {
            return response()->json(['error' => 'Rating not found'], 404);
        }
        try {
            $rating->delete();
        } 
        catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete the rating'], 500);
        }
        return response()->noContent();
    }
}
