<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Like;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\CreatePost; 
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    public function timeline()
    {
        //postsテーブルから降順で取得(n+1問題用with() & ページネーション用paginate()を使用)
        $posts = Post::with(['comments','likes'])->orderBy('created_at', 'desc')->paginate(10);

        return view('hello.timeline',[
            'posts' => $posts,
            ]);
    }

    public function showCreateForm()
    {
        return view('hello.create');
    }

    public function create(CreatePost $request)
    {
        // <input type="file" name="image">の値を受け取る
        $upload_image = $request->file('image');

        //画像付き投稿か否かで処理を分ける
        if($upload_image) {
            //アップロードされた画像を保存する
            $path = $upload_image->store('uploads',"public");
            //画像の保存に成功したらDBに記録する
                if($path){
                    Post::create([
                        'user_id' => Auth::user()->id,
                        'user_name' => Auth::user()->name,
                        'pass_class' => $request->pass_class,
                        'pass_date' => $request->pass_date,
                        'test_style' => $request->test_style,
                        'study_period' => $request->study_period,
                        'study_method' => $request->study_method,
                        'books_used' => $request->books_used,
                        'advice' => $request->advice,
                        'nunber_times' => $request->nunber_times,
                        'file_name' => $upload_image->getClientOriginalName(),
                        'file_path' => $path,
                    ]);
                }
        }else{
            //画像添付がなければ画像情報をNULLとする
            Post::create([
                'user_id' => Auth::user()->id,
                'user_name' => Auth::user()->name,
                'pass_class' => $request->pass_class,
                'pass_date' => $request->pass_date,
                'test_style' => $request->test_style,
                'study_period' => $request->study_period,
                'study_method' => $request->study_method,
                'books_used' => $request->books_used,
                'advice' => $request->advice,
                'nunber_times' => $request->nunber_times,
                'file_name' => null,
                'file_path' => null,
            ]);
        }

        // 多重投稿防止(JavaScript無効の場合)
        $request->session()->regenerateToken();

        return redirect()->route('timeline')->with('status', __('投稿しました。'));
    }

    public function show(int $post_id)
    {
        //該当する投稿を取得
        $post = Post::findOrFail($post_id);

        //紐づくコメントを取得
        $comments = Comment::where('post_id',$post_id)->paginate(10);

        return view('hello.show',[
            'post' => $post,
            'comments' => $comments,
        ]);
    }

    public function showEditForm(int $post_id)
    {
        //該当する投稿を取得
        $post = Post::findOrFail($post_id);

        //もし投稿者と更新者が異なる場合はエラーを返す
        if (Auth::id() != $post->user_id) {
            abort(403);
        }

        return view('hello.edit',[
            'post' => $post,
        ]);
    }

    public function edit(CreatePost $request,int $post_id)
    {
        //該当する投稿を取得
        $post = Post::findOrFail($post_id);

        //入力値を代入
        $post->pass_class = $request->pass_class;
        $post->pass_date = $request->pass_date;
        $post->test_style = $request->test_style;
        $post->study_period = $request->study_period;
        $post->study_method = $request->study_method;
        $post->books_used = $request->books_used;
        $post->advice = $request->advice;
        $post->nunber_times = $request->nunber_times;

        //データベースを更新
        $post->save();

        return redirect()->route('show',[
            'post_id' => $post->id,
        ])->with('status', __('更新しました。'));
    }

    public function delete(int $post_id)
    {
        //該当する投稿を取得
        $post = Post::findOrFail($post_id);

        //紐づくコメントを削除
        $post->comments()->delete();

        //紐づくいいねを削除
        $post->likes()->delete();

        //紐づく画像ファイルがあれば削除
        if($post->file_name){
            Storage::disk('public')->delete($post->file_path);
        }

        //投稿を削除
        $post->delete();

        return redirect()->route('timeline');
    }

    public function squeeze(Request $request)
    {
        //postsテーブルから該当するデータを検索して、降順で取得(n+1問題用with() & ページネーション用paginate()を使用)
        $posts = Post::with(['comments','likes'])->where('pass_class',$request->pass_class)->orderBy('created_at', 'desc')->paginate(10);

        return  view('hello.timeline',[
            'posts' => $posts,
        ]);
    }
}
