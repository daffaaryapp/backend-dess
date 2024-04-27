<?php

namespace App\Http\Controllers\Api\Public;

use App\Models\Slider;
use App\Http\Resources\SliderResource;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    //

    public function index()
    {
        $slider = Slider::latest()->get();

        return new SliderResource(true,'List Data Sliders',$slider);
    }
}
