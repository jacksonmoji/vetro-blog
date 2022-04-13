<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Blog;


class RatingController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Blog $blog, Request $request)
    {

        $this->validate($request, [
            'rating' => 'required',
        ]);

        $input = $request->all();

        $blog->ratings()->create([
            'rating' => $input['rating'],
        ]);

        return back();

    }

}
