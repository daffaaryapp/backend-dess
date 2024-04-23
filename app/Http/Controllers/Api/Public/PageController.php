<?php

namespace App\Http\Controllers\Api\Public;

use App\Models\Page;
use App\Http\Resources\PageResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PageController extends Controller
{

    public function index()
    {
        $pages = Page::oldest()->get();
    
        return new PageResource(true,'List Data Pages',$pages);
    }

    public function show($slug)
    {
        $page = Page::where('slug',$slug)->first();

        if($page){
            return new PageResource(true,'Detail Data Page',$page);
        }
        
        return new PageResource(false,'Detail Data Page Tidak Ditemukan',null);

    }



}
