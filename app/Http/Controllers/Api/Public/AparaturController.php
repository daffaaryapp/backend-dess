<?php

namespace App\Http\Controllers\Api\Public;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aparatur;
use App\Http\Resources\AparaturResource;

class AparaturController extends Controller
{
    //
    public function index()
    {
        $aparaturs = Aparatur::oldest()->get();

        return new AparaturResource(true,'List Data Aparaturs',$aparaturs);
    }
}
