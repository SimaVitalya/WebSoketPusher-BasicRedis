<?php

namespace App\Console\Commands;

use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;

class RedisTestCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'redis:go'; //название команды
    //команду потом легко запускать нужно просто написать php artisn name command

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $post =Post::find(1);

        Redis::set('posts:' . $post->id ,$post); //конкатынацию не путать
        //        Post::all()->each(function ($post){
        //            Cache::put('posts:' . $post->id, $post);
        //        }); //это была имитация сосдания
//        $data = [
//            'title' => 'some title',
//            'content' => 'cont',
//            'likes' => 20,
//        ];
//        $post = Post::created($data);
//        Cache::put('posts:' , $post->id); имитакия сосданния


        //        Post::factory(100)->create(); //таки образом мы сосдаем из фабрики пробные 100 постов


        //        $str ='some string';

        //        $result = Cache::rememberForever('my_string', function () use ($str) {
        //            return $str;
        //        });
        //Вот то что сверну написано это аналог того что написано снизу только кратко
        //        $result ='';
        //        if(Cache::has('my_string')){ //если есть то дай нам это а если нет то положи туда данные
        //            $result = Cache::get('my_string');
        //        }else{
        //            Cache::put('my_string',$str);
        //            $result = $str;
        //        }
        //         dd($result);


        //        //        dd('command ');для проверки вызываем php artisan redis:go(its my command name )
        //        Cache::put('example', 'my_string');//обращаеся к фасаду кеш через put
        //
        //        $str = Cache::get('example');//таким образом мы можем взять данные
        //        Cache::put('example', $str . ' new'); //таким образом мы переписали ключ
        //        Cache::forget('example');//таким образом мы стераем ключ
        //        $str = Cache::get('example');//таким образом мы можем взять данные


    }
}
