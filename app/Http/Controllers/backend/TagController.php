<?php

namespace App\Http\Controllers\backend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Tags;
use Auth;

class TagController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index() {
        $tag = Tags::first();
        return view('backends.tags.index', compact('tag'));
    }
    public function create(Request $request) {
        $tag_ = Tags::first();
        if(isset($tag)) {
            $tag_->delete();
        }
        $tag = new Tags();
        $tag->name = $request->create_tag;
        $name_seo = explode(",", $request->create_tag);
        $p = "";
        foreach ($name_seo as $key=>$val) {
            if($key ==0) {
                $p = str_seo_m(str_replace('.html', '', $name_seo[$key]));
            } else {
                $p = $p . "," . str_seo_m(str_replace('.html', '', $name_seo[$key]));
            }
        }
        $tag->name_seo = $p;
        $tag->user_id = Auth::id(0);
        $tag->save();
        return redirect()->back()->with('mes', 'Add tag name successful');
    }

    public function edit(Request $request) {
        $tag = Tags::first();
        $tag->name = $request->edit_tag;
        $name_seo = explode(",", $request->edit_tag);
        $p = "";
        foreach ($name_seo as $key=>$val) {

            if($key ==0) {
                $p = str_seo_m(str_replace('.html', '', $name_seo[$key]));
            } else {
                $p = $p . "," . str_seo_m(str_replace('.html', '', $name_seo[$key]));
            }
        }
        $tag->name_seo = $p;
        $tag->user_id = Auth::id(0);
        $tag->save();
        return redirect()->back()->with('mes', 'Add tag name successful');
    }
}
