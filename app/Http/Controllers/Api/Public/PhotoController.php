<?php

namespace App\Http\Controllers\Api\Public;

use App\Models\Photo;
use App\Http\Resources\PhotoResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    public function index()
    {
        $photos = Photo::latest()->paginate(9);

        return new PhotoResource(true,'List Data Photos',$photos);
    }
}
