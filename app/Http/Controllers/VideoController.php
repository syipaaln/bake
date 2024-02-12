<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $video = Video::latest()->paginate(5);
        return view('video.index', compact('video'))->with('i', (request()->input('page', 1) -1) *5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('video.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // $request->validate([
        //     'caption' => 'required',
        //     'url' => 'required'
        // ]);
        // Video::create($request->all());

        $id = $request->get('id');
        if($id){
            $video = Video::find($id);
        } else {
            $video = new Video;
        }
        if($request->hasFile('url')){
            $url = $request->file('url');
            $request->validate([
                'url' => 'required|file|mimes:mp4,jpeg,png,jpg,gif|max:10048',
            ]);
            $videoName = time() . '.' . $url->getClientOriginalExtension();
            $destinationPath = 'video/';
            $url->move($destinationPath, $videoName);
            $video->url = $videoName;
        }
        $video->user_id = $request->user_id;
        $video->caption = $request->caption;
        $video->save();
        return redirect()->route('vidio.index')->with('success', 'Video berhasil di unggah!');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $video)
    {
        $video->delete();
        // Hapus foto lama (jika ada)
        if ($video->url) {
            unlink(public_path('video/' . $video->url));
        }
        return redirect()->route('vidio.index')->with('success', 'Video berhasil di hapus!');
    }
}
