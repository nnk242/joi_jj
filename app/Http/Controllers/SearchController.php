<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Groups;

class SearchController extends Controller
{
    //
    public function search(Request $request, $id)
    {

//        Groups::where([['status', '=', 1], ['id', '<>', 1], ['name_seo', 'like', '%' . $id . '%']])
//            ->orderBy('id', 'DESC')->take(10)->get();
        $key_word = str_seo_m($id);
        $responses = Groups::where([['status', '=', 1], ['id', '<>', 1], ['name_seo', 'like', '%' . $key_word . '%']])
            ->orderBy('id', 'DESC')
            ->take(10)->get();
        return response()->json($responses);
    }
}
