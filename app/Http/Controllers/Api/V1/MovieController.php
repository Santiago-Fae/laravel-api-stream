<?php

namespace App\Http\Controllers\Api\V1;

use App\Models\Movie;
use App\Http\Controllers\Controller;
use App\Http\Resources\V1\MovieResource;
use App\Http\Resources\V1\MovieCollection;
use App\Http\Requests\V1\StoreMovieRequest;
use App\Http\Requests\V1\UpdateMovieRequest;
use App\Filters\V1\MovieFilter;
use Illuminate\Http\Request;
use App\Models\Rating;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     * 
     */
    public function index(Request $request)
    {
        $filter = new MovieFilter();
        $queryItems = $filter->transform($request);

        $movies = Movie::where($queryItems);
        
        $filter->applyGenreFilter($movies, $request);
        $movies->with('genre');

        if ($request->has('mediaRating')) {
            $movies->addSelect([
                'mediaRating' => Rating::selectRaw('ROUND(COALESCE(AVG(rating), 0), 2)')
                    ->whereColumn('id_movie', 'movies.id')
            ]);
        }
        return new MovieCollection($movies->paginate()->appends($request->query()));
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
     * @param  \App\Http\Requests\V1\StoreMovieRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreMovieRequest $request)
    {
        $existingMovieTitle = Movie::where('title', $request->title)->first();
        // Movie Title already exists
        if ($existingMovieTitle) {
            return response()->json(['error' => 'Title already exists'], 409);
        }

        return new MovieResource((Movie::create($request->all()))->loadMissing('genre'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function show(Movie $movie)
    {
        return new MovieResource($movie->loadMissing('genres'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function edit(Movie $movie)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateMovieRequest  $request
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateMovieRequest $request, Movie $movie)
    {
        $movie->update($request->all());
        return new MovieResource($movie->loadMissing('genre'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Movie  $movie
     * @return \Illuminate\Http\Response
     */
    public function destroy($movieId)
    {
        $movie = Movie::find($movieId);

        if (!$movie) {
            return response()->json(['error' => 'Movie not found'], 404);
        }
        try {
            $movie->delete();
        } 
        catch (\Exception $e) {
            return response()->json(['error' => 'Unable to delete the movie'], 500);
        }
        return response()->noContent();
    }
}
