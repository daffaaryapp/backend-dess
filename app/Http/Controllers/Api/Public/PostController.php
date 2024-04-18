<?php

namespace App\Http\Controllers\Api\Public;


use App\Models\Post;
use App\Http\Resources\PostResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostController extends Controller
{
    
    public function index()
    {
        $post = Post::with('user','category')->latest()->paginate(10);
        
        //return with api resource
        return new PostResource(true,'List Data Posts',$post);
    }

    public function show($slug)
    {
        $post = Post::with('user','category')->where('slug',$slug)->first();

        if($post){
            //return with api resource
            return new PostResource(true,"Detail Data Post",$post);

        }

        //return with api resource
        return new PostResource(false,'Detail Data Post Tidak Ditemukan',null);

    }


    public function homePage()
    {
        $posts = Post::with('user','category')->latest()->take(6)->get();

        //return with Api Resource
        return new PostResource(true,'List Data Post HomePage',$posts);
    }




}
