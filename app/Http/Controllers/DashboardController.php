<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard.index');
    }

    public function show(Post $post)
    {
        return view(
            'dashboard.show',
            [
                'slug' => $post->slug
            ]
        );
    }

    public function create()
    {
        return view('dashboard.create');
    }

    public function edit(Post $post)
    {

        return view('dashboard.edit', [
            'slug' => $post->slug
        ]);
    }
}
