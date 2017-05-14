<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

use App\Micropost;

class MicropostsController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request, [
            'content' => 'required|max:255',
            ]);
            
        $request->user()->microposts()->create([
            'content' => $request->content,
            ]);
        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $micropost = Micropost::find($id);

        if (\Auth::user()->id === $micropost->user_id) {
            $micropost->delete();
        }
        return redirect()->back();

    }

    public function index()
    {
        //
        $data = [];
        if (\Auth::check()) {
            $user = \Auth::user();
            $microposts = $user->users_favorites()->orderBy('created_at', 'desc')->paginate(10);

            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
        }
        return view('microposts.favorites', $data);
    }


}
