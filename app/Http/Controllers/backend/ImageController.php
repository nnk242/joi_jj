<?php

namespace App\Http\Controllers\backend;

use App\Groups;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use RemoteImageUploader\Factory;
use Validator;
use App\Images;
use Auth;
use File;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    protected $item_page = 10;
    protected $first_url_image = array('http');
    protected $folder_save_image = 'uploads/';
    protected $folder_save_image_small = 'uploads/smalls/';
    protected $quantity_image = 20;


    public function index(Request $request)
    {
        $images = Images::orderby('id', 'DESC')->paginate($this->item_page);
        $first_url_image = $this->first_url_image;
        return view('backends.images.index', compact('images', 'first_url_image'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('backends.images.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        // Tạo validate cho $request->upload:
        // - không được trống
        // - là file image
        // - max size là 2345678
//        return $request->group;
        $validator = Validator::make($request->all(), [
            'upload' => 'required|image',
        ]);
        // Nếu validate fail thì return thông báo lỗi
        //  |size:2345678
        if ($validator->fails()) {
            // gộp mảng errors thành chuỗi, cách nhau bởi dấu cách
            $message = implode(' ', $validator->errors()->all());

            return [
                'status' => false,
                'url' => '',
                'message' => 'Upload fail! ' . $message,
            ];
        } else {
            try {
                // Thực hiện create và upload photo với config đã cài sẵn
                $result = Factory::create(config('uploadphoto.host'), config('uploadphoto.auth'))
                    ->upload($request->upload->path());

                return [
                    'status' => true,
                    'url' => $result,
                    'data' => $request->all(),
                    'message' => 'Upload successfull!',
                ];
            } catch (\Exception $ex) {
                // Nếu bị Exception thì trả về message của Exception đó
                // Exception ở đây có thể là:
                // - host không hợp lệ
                // - api không hợp lệ
                // - xác thực auth không thành công
                // - không có quyền upload
                // - php không enable curl
                return [
                    'status' => false,
                    'url' => '',
                    'message' => 'Upload fail! ' . $ex->getMessage(),
                ];
            }
        }


    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $image = Images::find($id);
        $groups = Groups::all();
        $first_url_image = $this->first_url_image;
        return view('backends.images.edit', compact('image', 'groups', 'first_url_image'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'url' => 'required|max:255',
            'link' => 'required|max:255',
            'title' => 'required|max:255',
            'content_' => 'required|max:255',
        ]);
        $str = '';
        if ($validator->fails()) {
            // gộp mảng errors thành chuỗi, cách nhau bởi dấu cách
            $message = implode(' ', $validator->errors()->all());
            return redirect()->back()->with('er', 'Update fail...' . $message);
        } else {
            $image = Images::find($id);
            try {
                if ($request->image) {
                    $filepath = $image->url;
                    $extension = $request->file('image')->getClientOriginalExtension();
                    $dir = $this->folder_save_image;
                    $filename = uniqid() . '_' . time() . '.' . $extension;
                    //small image
                    compress($request->file('image'), $this->folder_save_image_small . $filename, $this->quantity_image);
                    $request->file('image')->move($dir, $filename);
                    $check_name = substr($image->url, 0, 4);
                    if (!in_array($check_name, $this->first_url_image)) {
                        try {
                            File::delete($this->folder_save_image_small . $filename);
                            File::delete($filepath);
                        } catch (\Exception $ex) {
                            $str = "File not found";
                        }
                    }
                    $image->url = $dir . $filename;
                    $image->url_seo = $this->folder_save_image_small . $filename;
                }

                $name = $request->name;
                $status = $request->status;
                $image->user_id = Auth::id();
                $image->name = $name;
                $image->image_s = $request->link;
                $image->title = $request->title;
                $image->content = $request->content_;
                $image->group_id = $request->group;
                $image->status = $status == 1 ? 1 : 0;
                $image->save();
                return redirect()->back()->with('mes', 'Updated... ' . $str);
            } catch (\Exception $exception) {
                return redirect()->back()->with('er', 'Update fail...');
            }
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $image = Images::find($id);
        $str = '';
        if ($image) {
            try {
                $image_url = $image->url;
                $check_name = substr($image_url, 0, 4);
                if (!in_array($check_name, $this->first_url_image)) {
                    try {
                        File::delete($image_url);
                        File::delete($image->url_seo);
                    } catch (\Exception $ex) {
                        $str = "File not found";
                    }
                }
                $image->delete();
            } catch (\Exception $ex) {
                return redirect()->back()->with('er', 'Delete item error... ' . $str);
            }
            return redirect()->back()->with('mes', 'Deleted item...');
        } else
            return redirect()->back()->with('er', 'Item not found...');
    }

    public function loadingGroup()
    {
        return Groups::orderBy('id', 'ASC')->get();
    }

    public function uploadAFile(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'title' => 'required|max:255',
            'url' => 'max:255',
            'name' => 'required',
            'group_id' => 'required'
        ]);
        if ($validator->fails()) {
            // gộp mảng errors thành chuỗi, cách nhau bởi dấu cách
            $message = implode(' ', $validator->errors()->all());
            return [
                'status' => false,
                'message' => 'Upload fail! ' . $message,
            ];
        } else {
            $url = $request->url;
            $name = $request->name;
            $title = $request->title;
            $content = $request->content_;
            $group = $request->group_id;
            $status = $request->status;
            try {
                $image = new Images();
                $image->user_id = Auth::id();
                $image->url = $url;
                $image->name = $name;

                if (Images::whereimage_s(str_seo_m($name))->count() > 0) {
                    $image_s = str_seo_m(str_replace('.html', '', $name)) . '-' . time();
                    if (Images::whereimage_s($image_s)->count() > 0) {
                        $image_s2 = str_seo_m(str_replace('.html', '', $name)) . uniqid() . '-' . time();
                        if (Images::whereimage_s($image_s2)->count() > 0) {
                            $image->image_s = str_seo_m(str_replace('.html', '', $name)) . uniqid() . '-' .
                                time() . '-' . uniqid();
                        } else $image->image_s = str_seo_m(str_replace('.html', '', $name)) . uniqid() .
                            '-' . time();
                    } else $image->image_s = str_seo_m(str_replace('.html', '', $name)) . '-' . time();
                } else $image->image_s = str_seo_m($name);

                $image->title = $title;
                $image->content = $content;
                $image->group_id = $group;
                $image->status = $status == 1 ? 1 : 0;

                $image->save();
                return [
                    'status' => true,
                    'message' => 'Upload successful!' . str_seo_m($name . time())
                ];
            } catch (\Exception $ex) {
                return [
                    'status' => false,
                    'message' => 'Upload fail!!!'
                ];
            }
        }

    }

    public function uploadFile(Request $request)
    {
        $group_check = $request->group_check;
        $name_check = $request->name_check;
        $title_check = $request->title_check;
        $content_check = $request->content_check;
        $status_check = $request->status_check;
        $url = $request->u_link;
        $type = $request->u_type_upload;
        $file_upload = $request->file('u_upload_file_m');

        $k = 0;

        $count_item = count($request->u_link);

        $group = [];
        $title = [];
        $content = [];
        $name = [];
        $status = [];

        //group
        if ($group_check == 1) {
            for ($i = 0; $i < $count_item; $i++) {
                $group[$i] = $request->group;
            }
        } else $group = $request->u_group;
        //name
        if ($name_check == 1) {
            for ($i = 0; $i < $count_item; $i++) {
                $name[$i] = $request->p_name;
            }
        } else $name = $request->u_name;
        //title
        if ($title_check == 1) {
            for ($i = 0; $i < $count_item; $i++) {
                $title[$i] = $request->p_title;
            }
        } else $title = $request->u_title;
        //contents
        if ($content_check == 1) {
            for ($i = 0; $i < $count_item; $i++) {
                $content[$i] = $request->p_content;
            }
        } else $content = $request->u_content;
        //status
        if ($status_check == 1) {
            for ($i = 0; $i < $count_item; $i++) {
                $status[$i] = $request->p_status;
            }
        } else $status = $request->u_status;
        //update
        $dir = $this->folder_save_image;
        try {
            for ($i = 0; $i < $count_item; $i++) {
                $image = new Images();

                $image->user_id = Auth::id();

                if ($type[$i] == "1") {
                    try {
                        $extension = $file_upload[$k]->getClientOriginalExtension();
                        $filename = uniqid() . '_' . time() . '.' . $extension;
                        compress($file_upload[$k], $this->folder_save_image_small . $filename, $this->quantity_image);
                        $file_upload[$k]->move($dir, $filename);
                        $image->url = $dir . $filename;
                        $image->url_seo = $this->folder_save_image_small . $filename;

                        $k++;
                    } catch (\Exception $exception) {
                        File::delete($dir . $filename);
                        File::delete($this->folder_save_image_small . $filename);
                        return redirect()->back()->with('er', 'Upload file ' . $i . ' fail...');
                    }
                } else {
                    if (isset($url[$i])) {
                        $image->url = $url[$i];
                    }
                }
                $image->name = $name[$i];
                $image->image_s = Images::whereimage_s(str_seo_m($name[$i]))->count() > 0 ? str_seo_m(
                        str_replace('.html', '', $name[$i])) . '-' . time() . $i : str_seo_m($name[$i]);
                $image->title = $title[$i];
                $image->content = $content[$i];
                $image->group_id = $group[$i];
                $image->status = $status[$i] == 1 ? 1 : 0;
                $image->save();
            }

            return redirect()->back()->with('mes', 'Upload successful...');
        } catch (\Exception $ex) {
            return redirect()->back()->with('er', 'Upload fail...');
        }
    }

    public function ajaxStatus(Request $request)
    {
        try {
            $id = $request->id;
            $status = $request->status;
            $image = Images::find($id);
            $status == 1 ? $image->status = 0 : $image->status = 1;
            $image->save();
            return [
                'status' => true,
                'message' => 'Status changed successful!'
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => 'Status change fail!!!'
            ];
        }
    }

    public function getUrl(Request $request)
    {
        try {
            $name = $request->name;
            if (Images::whereimage_s(str_seo_m($name))->count() > 0) {
                $image_s = str_seo_m(str_replace('.html', '', $name)) . '-' . time();
                if (Images::whereimage_s($image_s)->count() > 0) {
                    $image_s2 = str_seo_m(str_replace('.html', '', $name)) . uniqid() . '-' . time();
                    if (Images::whereimage_s($image_s2)->count() > 0) {
                        $image = str_seo_m(str_replace('.html', '', $name)) . uniqid() . '-' . time() . '-'
                            . uniqid();
                    } else $image = str_seo_m(str_replace('.html', '', $name)) . uniqid() . '-' . time();
                } else $image = str_seo_m(str_replace('.html', '', $name)) . '-' . time();
            } else $image = str_seo_m($name);
            return [
                'status' => true,
                'value_seo' => $image,
                'message' => 'Get url seo successful!'
            ];
        } catch (\Exception $ex) {
            return [
                'status' => false,
                'message' => 'Get url fail!!!'
            ];
        }
    }

    public function uploadFileServe(Request $request)
    {
        $validator = Validator::make($request->all(),
            [
                'file' => 'image',
                'name' => 'required|max:255',
                'title' => 'required|max:255',
                'content_' => 'required|max:255',
            ],
            [
                'file.image' => 'Image must (jpeg, png, bmp, gif, or svg)'
            ]);
        if ($validator->fails()) {
            $message = implode(' ', $validator->errors()->all());
            return [
                'status' => false,
                'data' => $request->all(),
                'message' => $message,
            ];
        } else {
            try {
                $name = $request->name;
                $status = $request->status;
                $image = new Images();
                $extension = $request->file('file')->getClientOriginalExtension();
                $dir = $this->folder_save_image;
                $filename = uniqid() . '_' . time() . '.' . $extension;
                compress($request->file('file'), $this->folder_save_image_small . $filename, $this->quantity_image);
                $request->file('file')->move($dir, $filename);

                $image->user_id = Auth:: id();
                $image->url = $dir . $filename;
                $image->url_seo = $this->folder_save_image_small . $filename;
                $image->name = $request->name;

                if (Images::whereimage_s(str_seo_m($name))->count() > 0) {
                    $image_s = str_seo_m(str_replace('.html', '', $name)) . '-' . time();
                    if (Images::whereimage_s($image_s)->count() > 0) {
                        $image_s2 = str_seo_m(str_replace('.html', '', $name)) . uniqid() . '-' . time();
                        if (Images::whereimage_s($image_s2)->count() > 0) {
                            $image->image_s = str_seo_m(str_replace('.html', '', $name)) . uniqid() . '-' .
                                time() . '-' . uniqid();
                        } else $image->image_s = str_seo_m(str_replace('.html', '', $name)) . uniqid() . '-' . time();
                    } else $image->image_s = str_seo_m(str_replace('.html', '', $name)) . '-' . time();
                } else $image->image_s = str_seo_m($name);

                $image->title = $request->title;
                $image->content = $request->content_;
                $image->group_id = $request->group;
                $image->status = $status == 1 ? 1 : 0;
                $image->save();
                return [
                    'status' => true,
                    'url' => $filename,
                    'data' => $request->all(),
                    'message' => 'uploaded.',
                ];
            } catch (\Exception $exception) {
                File::delete($dir . $filename);
                File::delete($this->folder_save_image_small . $filename);
                return [
                    'status' => false,
                    'data' => $request->all(),
                    'message' => 'upload fail.',
                ];
            }
        }
    }
}
