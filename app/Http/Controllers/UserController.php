<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function showWithdrawalForm()
    {
        return view('hello.withdrawal');
    }

    public function delete(Request $request)
    {
        // ログアウトする
        Auth::logout();

        //該当するユーザーを取得して削除
        User::findOrFail($request->user_id)->delete();

        return redirect()->route('timeline')->with('status', __('ご利用ありがとうございました。また機会がございましたらご利用下さいませ。お待ちしております。'));
    }
}
