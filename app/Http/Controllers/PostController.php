<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class PostController extends Controller
{
    public function index()
    {
        //если надо добавить вромя жизни то меняет rememberForever на просто remember и пишем 2 параметром еще время жизни как то так 60*60
        $posts = Cache::rememberForever('posts:all', function () {
            return Post::all();
        });//таким образом мы сохранили все наши посты в кеш
        dump($posts->pluck('title'));

    }

    public function show($id)
    {

        //тут вместо show(Post $post) нужно прописать $id что бы через редис
        $posts = Cache::get('posts:' . $id);//так мы будем сосдать кеш когда только в 1 раз заходим
        dd($posts->title);
    }
}
