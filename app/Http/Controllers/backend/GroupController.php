<?php

namespace App\Http\Controllers\backend;

use App\Continents;
use App\Groups;
use App\Regions;
use App\Types;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Validator;
use File;

class GroupController extends Controller
{
    //

    public function __construct()
    {
        $this->middleware('auth');
    }

    protected $item_group = 10;
    protected $first_url_image = array('http');
    protected $folder_save_image = 'uploads/regions/';
    protected $folder_save_image_group = 'uploads/thumbnails/';
    protected $quantity_image = 20;

    public function index()
    {
        $groups = Groups::orderBy('id', 'DESC')->paginate($this->item_group);
        $regions = Regions::all();
        $continents = Continents::all();
        $types = Types::all();
        $first_url_image = $this->first_url_image;
        return view('backends.groups.index', compact('groups', 'regions', 'continents', 'types', 'first_url_image'));
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ]);
        if ($validator->fails()) {

            // gộp mảng errors thành chuỗi, cách nhau bởi dấu cách
            $message = implode(' ', $validator->errors()->all());
            return redirect()->back()->with('er', 'Update group fail...' . $message);
        } else {
            try {
                $group = new Groups();
                $name = $request->name;
                $status = $request->status;
                $tag = $request->tag;

                $tag_seo = explode(",", $tag);
                $p = "";
                foreach ($tag_seo as $key=>$val) {
                    if($key ==0) {
                        $p = str_seo_m(str_replace('.html', '', $tag_seo[$key]));
                    } else {
                        $p = $p . "," . str_seo_m(str_replace('.html', '', $tag_seo[$key]));
                    }
                }
                $group->tag = $tag;
                $group->tag_seo = $p;

                $group->user_id = Auth::id();
                $group->name = $name;
                if ($request->group_image) {
                    $extension = $request->file('group_image')->getClientOriginalExtension();
                    $dir = $this->folder_save_image_group;
                    $filename = uniqid() . '_' . time() . '.' . $extension;
                    compress($request->file('group_image'), $dir . $filename, $this->quantity_image);
//                    $request->file('group_image')->move($dir, $filename);

                    $group->thumbnail = $dir. $filename;
                } else {
                    $group->thumbnail = $request->link_group_image;
                }

                $group->type_id = $request->type_id;

                $group->name_seo = Groups::wherename_seo($name)->count() > 0 ? str_seo_m(str_replace('.html', '', $name)) . '-' . time() : str_seo_m($name);
                $group->description = $request->description;
                $group->region_id = $request->region;
                $group->status = $status == 1 ? 1 : 0;
                $group->save();
                return redirect()->back()->with('mes', 'Created group');
            } catch (\Exception $ex) {
                return 2;
                return redirect()->back()->with('er', 'Update group fail...');
            }

        }
    }

    public function edit($id)
    {
        $first_url_image = $this->first_url_image;
        $group = Groups::find($id);
        $types = Types::all();
        $regions = Regions::all();
        return view('backends.groups.edit', compact('group', 'regions', 'first_url_image', 'types'));
    }

    public function postEdit($id, Request $request)
    {
        try {
            $str = '';
            $status = $request->status;
            $group = Groups::find($id);
            $group->user_id = Auth::id();
            $group->name = $request->name;
            $group->name_seo = $request->name_seo;

            $tag = $request->tag;

            $tag_seo = explode(",", $tag);
            $p = "";
            foreach ($tag_seo as $key=>$val) {
                if($key ==0) {
                    $p = str_seo_m(str_replace('.html', '', $tag_seo[$key]));
                } else {
                    $p = $p . "," . str_seo_m(str_replace('.html', '', $tag_seo[$key]));
                }
            }
            $group->tag = $tag;
            $group->tag_seo = $p;

            if ($request->image_thumbnail) {
                $extension = $request->file('image_thumbnail')->getClientOriginalExtension();
                $dir = $this->folder_save_image_group;
                $filename = uniqid() . '_' . time() . '.' . $extension;
//                $request->file('image_thumbnail')->move($dir, $filename);
                compress($request->file('image_thumbnail'), $dir . $filename,
                    $this->quantity_image);

                $filepath = $group->thumbnail;
                $check_name = substr($filepath, 0, 4);

                if (!in_array($check_name, $this->first_url_image)) {
                    try {
                        File::delete($filepath);
                    } catch (\Exception $ex) {
                        $str = "File not found";
                    }
                }

                $group->thumbnail = $dir . $filename;
            } else {
                if($request->link_image_thumbnail)
                    $group->thumbnail = $request->link_image_thumbnail;
            }

            $group->description = $request->description;
            $group->region_id = $request->region;
            $group->type_id = $request->type;
            $group->status = $status == 1 ? 1 : 0;
            $group->save();
            return redirect()->back()->with('mes', 'edited group. ' . $str);
        } catch (\Exception $exception) {
            return redirect()->back()->with('er', 'edit group fail.');
        }
    }

    public function delete($id)
    {
        try {
            $str = '';
            $group = Groups::find($id);

            $filepath = $group->thumbnail;
            $check_name = substr($filepath, 0, 4);

            if (!in_array($check_name, $this->first_url_image)) {
                try {
                    File::delete($filepath);
                } catch (\Exception $ex) {
                    $str = "File not found";
                }
            }
            $group->delete();
            return redirect()->back()->with('mes', 'Deleted group. ' . $str);
        } catch (\Exception $exception) {
            return redirect()->back()->with('er', 'Delete group fail...');
        }
    }

    //region
    public function createRegion(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            // gộp mảng errors thành chuỗi, cách nhau bởi dấu cách
            $message = implode(' ', $validator->errors()->all());
            return redirect()->back()->with('er', 'Update region fail...' . $message);
        } else {
            try {
                $region = new Regions();
                $name = $request->name;
                $status = $request->status;

                $region->user_id = Auth::id();
                if ($request->flag_image) {
                    $extension = $request->file('flag_image')->getClientOriginalExtension();
                    $dir = $this->folder_save_image;
                    $filename = uniqid() . '_' . time() . '.' . $extension;

                    $request->file('flag_image')->move($dir, $filename);
                    $region->image = $dir . $filename;
                } else {
                    $region->image = $request->image;
                }
                $region->continent_id = $request->continent;
                $region->name = $name;
                $region->name_seo = Regions::wherename_seo($name)->count() > 0 ? str_seo_m(str_replace('.html',
                        '', $name)) . '-' . time() : str_seo_m($name);
                $region->description = $request->description;
                $region->status = $status == 1 ? 1 : 0;
                $region->save();
                return redirect()->back()->with('mes', 'Created region');
            } catch (\Exception $ex) {
                return redirect()->back()->with('er', 'Update region fail...');
            }

        }
    }

    public function deleteRegion($id)
    {
        $str = '';
        try {
            $region = Regions::find($id);
            $region->delete();
            $filepath = $region->image;
            $check_name = substr($filepath, 0, 4);
            if (!in_array($check_name, $this->first_url_image)) {
                try {
                    File::delete($filepath);
                } catch (\Exception $ex) {
                    $str = "File not found";
                }
            }

            return redirect()->back()->with('mes', 'Deleted region. ' . $str);
        } catch (\Exception $exception) {
            return redirect()->back()->with('er', 'Delete region fail...');
        }
    }

    public function editRegion($id)
    {
        $first_url_image = $this->first_url_image;
        $region = Regions::find($id);
        return view('backends.groups.editRegion', compact('region', 'first_url_image'));
    }

    public function postEditRegion($id, Request $request)
    {
        $str = '';

        $region = Regions::find($id);

        if ($request->flag_image) {
            $filepath = $region->image;
            $extension = $request->file('flag_image')->getClientOriginalExtension();
            $dir = $this->folder_save_image;
            $filename = uniqid() . '_' . time() . '.' . $extension;
            $request->file('flag_image')->move($dir, $filename);
            $check_name = substr($filepath, 0, 4);
            if (!in_array($check_name, $this->first_url_image)) {
                try {
                    File::delete($filepath);
                } catch (\Exception $ex) {
                    $str = "File not found";
                }
            }
            $region->image = $dir . $filename;
        } else {
            if ($request->image) {
                $region->image = $request->image;
            }
        }
        $status = $request->status;
        $region->user_id = Auth::id();
        $region->name = $request->name;
        $region->name_seo = $request->name_seo;
        $region->description = $request->description;
        $region->status = $status == 1 ? 1 : 0;
        $region->save();
        return redirect()->back()->with('mes', 'edited region. ' . $str);
    }

    public function getNameSeoRegion(Request $request)
    {
        try {
            $name = $request->name;
            $region = Regions::wherename_seo(str_seo_m($name))->count() > 0 ? str_seo_m(str_replace('.html', '', $name)) . '-' . time() : str_seo_m($name);
            return [
                'status' => true,
                'value_seo' => $region,
                'message' => 'Get name seo successful!'
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => 'Get name seo fail!!!'
            ];
        }
    }

    public function getNameSeoGroup(Request $request)
    {
        try {
            $name = $request->name;
            $group = Groups::wherename_seo(str_seo_m($name))->count() > 0 ? str_seo_m(str_replace('.html', '', $name)) . '-' . time() : str_seo_m($name);
            return [
                'status' => true,
                'value_seo' => $group,
                'message' => 'Get name seo successful!'
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => 'Get name seo fail!!!'
            ];
        }
    }

    public function createType(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'typename' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            // gộp mảng errors thành chuỗi, cách nhau bởi dấu cách
            $message = implode(' ', $validator->errors()->all());
            return redirect()->back()->with('er', 'Update type fail...' . $message);
        } else {
            try {
                $type = new Types();
                $name = $request->typename;
                $type->user_id = Auth::id();
                $type->name = $name;
                $type->name_seo = Types::wherename_seo($name)->count() > 0 ? str_seo_m(str_replace('.html', '', $name)) . '-' . time() : str_seo_m($name);
                $type->save();
                return redirect()->back()->with('mes', 'added type. ');
            } catch (\Exception $exception) {
                return redirect()->back()->with('er', 'add type fail. ');
            }

        }
    }

    public function deleteType($id)
    {
        try {
            Types::find($id)->delete();
            return redirect()->back()->with('mes', 'deleted type. ');
        } catch (\Exception $exception) {
            return redirect()->back()->with('er', 'delete type fail. ');
        }
    }

    public function editType($id, Request $request)
    {
        try {
            $type = Types::find($id);
            $name = $request->name;
            $type->name = $name;
            $type->user_id = Auth::id();
            $type->name_seo = Types::wherename_seo(str_seo_m($name))->count() > 0 ? str_seo_m(str_replace('.html', '', $name)) . '-' . time() : str_seo_m($name);
            $type->save();
            return redirect()->back()->with('mes', 'edited type. ');
        } catch (\Exception $exception) {
            return redirect()->back()->with('er', 'edit type fail. ');
        }
    }

    public function createContinent(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'continentname' => 'required|max:255'
        ]);
        if ($validator->fails()) {
            // gộp mảng errors thành chuỗi, cách nhau bởi dấu cách
            $message = implode(' ', $validator->errors()->all());
            return redirect()->back()->with('er', 'Update continent fail...' . $message);
        } else {
            try {
                $type = new Continents();
                $name = $request->continentname;
                $type->user_id = Auth::id();
                $type->name = $name;
                $type->name_seo = Continents::wherename_seo($name)->count() > 0 ? str_seo_m(str_replace('.html', '', $name)) . '-' . time() : str_seo_m($name);
                $type->save();
                return redirect()->back()->with('mes', 'added continent. ');
            } catch (\Exception $exception) {
                return redirect()->back()->with('er', 'add continent fail. ');
            }

        }
    }

    public function deleteContinent($id)
    {
        try {
            Continents::find($id)->delete();
            return redirect()->back()->with('mes', 'deleted continent. ');
        } catch (\Exception $exception) {
            return redirect()->back()->with('er', 'delete continent fail. ');
        }
    }

    public function editContinent($id, Request $request)
    {
        try {
            $type = Continents::find($id);
            $name = $request->name;
            $type->name = $name;
            $type->user_id = Auth::id();
            $type->name_seo = Continents::wherename_seo(str_seo_m($name))->count() > 0 ? str_seo_m(str_replace('.html', '', $name)) . '-' . time() : str_seo_m($name);
            $type->save();
            return redirect()->back()->with('mes', 'edited continent. ');
        } catch (\Exception $exception) {
            return redirect()->back()->with('er', 'edit continent fail. ');
        }
    }
}