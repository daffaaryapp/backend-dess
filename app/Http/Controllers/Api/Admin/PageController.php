<?php

namespace App\Http\Controllers\Api\Admin;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\PageResource;
use Illuminate\Support\Facades\Validator;


class PageController extends Controller
{
    


    public function index()
    {
        //get pages
        $pages = Page::when(request()->search,function($pages){
            $pages = $pages->where('title','like', '%'. request()->search .'%');
        })->latest()->paginate(5);

        //append query string to pagination links
        $pages->appends(['search' => request()->search]);

        //return api
        return new PageResource(true,'List Data Pages',$pages);
    }


    public function store (Request $request)
    {
        $validator = Validator::make(request()->all(),[
            'title' => 'required',
            'content' => 'required',
        ]);

        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }

        //create page
        $page = Page::create([
            'title' => $request->title,
            'slug'  => Str::slug($request->title),
            'content' =>$request->content,
            'user_id'=> auth()->guard('api')->user()->id
        ]);

        if($page){
            //return api success
            return new PageResource(true,'Data Page Berhasil  Disimpan',$page);
        }
        
        //failed
        return new PageResource(false,'Data Page Gagal Disimpan',null);
        
    }
    
    
    public function show($id)
    {
        $page = Page::whereId($id)->first();
        
        if($page){
            //success
            return new PageResource(true,'Detail Data Page',$page);
        }
        //fail
        return new PageResource(false,'Detail Data Page Gagal Ditemukan',null);
    }
    


    public function update(Request $request , Page $page)
    {
        $validator = Validator::make($request->all(),[
            'title' => 'required',
            'content' => 'required',
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors(),422);
        }
        
        //update page
        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'user_id' => auth()->guard('api')->user()->id
        ]);
        
        if($page){
            //success
            return new PageResource(true,'Data Page Berhasil Diupdate',$page);
            
        }
        //fail
        return new PageResource(false,'Data Page Gagal Diupdate',null);
        
    }
    
    public function destroy(Page $page)
    {
        if($page->delete()){
            //success
            return new PageResource(true,'Data Page Berhasil Dihapus',null);
        }
        //fail
        return new PageResource(false,'Data Page Gagal Dihapus',null);
    }

}
