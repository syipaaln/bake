<?php

namespace App\Http\Controllers;

use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class VideoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::latest()->paginate(5);
        return view('video.index', compact('videos'))->with('i', (request()->input('page', 1) -1) *5);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('video.create');
    }


    public function store(Request $request)
    {
        // $user = auth()->user();
        // $id = $request->get('id');
        // if($id){
        //     $videos = Video::find($id);
        // } else {
        //     $videos = new Video;
        // }
        // if($request->hasFile('video')){
        //     $video = $request->file('video');
        //     $request->validate([
        //         'video' => 'required|file|mimes:mp4,jpeg,png,jpg,gif|max:10048',
        //     ]);
        //     $videoName = time() . '.' . $video->getClientOriginalExtension();
        //     $destinationPath = 'video/';
        //     $video->move($destinationPath, $videoName);
        //     $videos->video = $videoName;
        // }
        // $videos->created_by = $user->id;
        // $videos->caption = $request->caption;
        // $videos->save();
        // return redirect()->route('vidio.index')->with('success', 'Video berhasil di unggah!');

        $request->validate([
            // 'video' => 'required|file|mimes:mp4',
            'video' => ['required', 'mimes:mp4', 'max:10048']
        ]);

        $user = auth()->user();
        $videos = new Video();
        $videos->created_by = $user->id;
        $videos->video =$request->file('video')->store('videos');
        $videos->caption = $request->caption;

        // if ($request->hasFile('video')) {
        //     $path = $request->file('video')->store('uploads');
        //     $videos->video = $path;
        // }

        $videos->save();

        // if ($videos) {
            return redirect(route('vidio.index'))->with('success','Added!');
        // }
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Video $videos)
    {
        // ($videos->delete());
       // $videos->query("DELETE FROM videos WHERE id = '$videos'") or die ($videos->error);
        // // Hapus foto lama (jika ada)
        //  if ($videos->destroy) { 
        //    unlink(public_path('videos/' . $videos->video));
        // }
        //return redirect()->route('vidio.index')->with('success', 'Video berhasil di hapus!');

          if($videos->video) {
           Storage::delete($videos->video);
         }
        if ($videos->delete()) {
            return redirect()->route('vidio.index')->with('success', 'Video berhasil di hapus!');
         }
        return redirect()->route('vidio.index')->with('error', 'Video gagal di hapus!');
    }
}