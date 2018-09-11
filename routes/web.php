<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');

});
//
//Route::get('/about', function () {
//    return "hi about page";
//
//});
//
//Route::get('admin/posts/example', array('as'=>'admin.home' ,function() {
//  $url= route('admin.home');
//    return "this url is ". $url;
//}));
//
//Route::get('/post/{id}/{name}', function ($id, $name){
//    return "This is post number ". $id . " " . $name;
//});
//
Route::group(['middleware' => ['web']], function(){

});

Route::get('/contact' , 'PostsController@contact');

Route::get('/post/{id}' , 'PostsController@show_post');

//Route::get('/post/{id}', 'PostsController@index');

Route::resource('posts', 'PostsController');

Route::get('/insert', function(){
   DB::insert('insert into posts(title, content) values(?,?)', ["Uuuuuuuuuuhhhhhh", 'Haaaaaa gaaaaaay']);
});

//--------------------------------------------------------------------------
//| DATABASE Raw SQL Queries
//|--------------------------------------------------------------------------
Route::get('/read', function(){
    $results= DB::select('select * from posts where id = ?', [4]);
    foreach ($results as $post){
        return $post->title;
    }
});

Route::get('/update', function(){
    $updated = DB::update('update posts set title = "update title" where id = ?', [1]);

    return $updated;
});

Route::get('/delete', function(){
   $deleted= DB::delete('delete from posts where id = ?', [1]);
   return $deleted;
});

//--------------------------------------------------------------------------
//| ELOQUENT
//|--------------------------------------------------------------------------
use App\Post;
Route::get('/find', function(){
    $posts = Post::find(3);

    return $posts->title;

//    foreach ($posts as $post){
//        return $post->title;
//    }
});

Route::get('/findwhere', function (){
    $postss = Post::where('id', 5)->orderBy('id', 'desc')->get();
    return $postss;
});

Route::get('/findmore', function (){
    $postal = Post::where('user_count', '<', 50)->firstOrFail();
});

Route::get('/basicinsert', function (){
    $post = new Post;
    $post->title ='New Eloquent title insert';
    $post->content = 'Wow eloquent is really cool';

    $post->save();
});

Route::get('/create', function (){
    Post::create(['title'=>'the create method', 'content'=> 'Wauw sooo cool']);
});

Route::get('/updating', function (){
Post::where('id', 2)->where('is_admin', 0)->update(['title'=>'NEW PHP TITLE', 'content'=>'I love a']);
});