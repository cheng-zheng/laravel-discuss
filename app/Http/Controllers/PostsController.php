<?php

namespace App\Http\Controllers;

use App\Discussion;
use App\Http\Requests\StoreBlogPostRequest;
use App\Markdown\Markdown;
use Illuminate\Http\Request;
use EndaEditor;
use Illuminate\Support\Facades\Input;

class PostsController extends Controller
{
    protected $markdown;

    public function __construct(Markdown $markdown)
    {
        $this->middleware('auth.admin',['only'=>['create','store','edit','update']]);
        $this->markdown = $markdown;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * 首页
     */
    public function index()
    {
        //dd(session()->all());
        //测试测试
        $arr = [
            'merchant_id'        => 'your-mch-id',
            'key'                => 'key-for-signature',
            'cert_path'          => 'path/to/your/cert.pem', // XXX: 绝对路径！！！！
            'key_path'           => 'path/to/your/key',      // XXX: 绝对路径！！！！
            'notify_url'         => '默认的订单回调地址',   
        ];
        //$order = json_encode([$arr]);
        //session(['test_arr'=>$arr]);
        //测试测试
        $discussions = Discussion::latest()->get();
        return view('forum.index',compact('discussions'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     * 显示帖子详情
     */
    public function show($id)
    {
        //dd(session('test_arr'));
        $discussion = Discussion::findOrFail($id);
        $html = $this->markdown->markdown($discussion->body);
        //dd($html);
        return view('forum.show',compact('discussion','html'));
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function edit($id)
    {
        $discussion = Discussion::findOrFail($id);
        if(\Auth::user()->id !== $discussion->user_id){
            return redirect('/');
        }
        return view('forum.edit',compact('discussion'));
    }
    public function update(StoreBlogPostRequest $request, $id)
    {
        $discussion = Discussion::findOrFail($id);
        $discussion->update($request->all());
        return redirect()->action('PostsController@show',['id'=>$discussion]);
    }
    public function upload()
    {
        $data = EndaEditor::uploadImgFile('uploads');
        return json_encode($data);
    }
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View|\think\response\View
     */
    public function create()
    {
        return view('forum.create');
    }

    /**
     * @param StoreBlogPostRequest $request
     * @return \Illuminate\Http\RedirectResponse
     * 创建帖子
     */
    public function store(StoreBlogPostRequest $request)
    {
        $data = [
            'list_user_id'=>\Auth::user()->id,
            'user_id'=>\Auth::user()->id,
        ];
        //dd(array_merge($request->all(),$data));
        $discussion = Discussion::create(array_merge($request->all(),$data));

        return redirect()->action('PostsController@show',['id'=>$discussion->id]);
    }
    public function test(Request $request){
        $arr = Input::get();
        return $arr['test'];
        return (string)request('remarks');
    }
}
