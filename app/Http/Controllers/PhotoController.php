<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

use \App\User;
use \App\Photo;

class PhotoController extends Controller
{

    public function __construct(){
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $userId = auth()->user()->id;

        $user = User::find($userId);

        return view('manage.photo.index')->with('photos', $user->photos);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('manage.photo.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
          'name' => 'required',
          'file' => 'image|max:1999'
        ]);

        $fileNameWithExt = $request->file('file')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $extension = $request->file('file')->getClientOriginalExtension();
        $fileNameToSave = $fileName.'_'.time().'.'.$extension;

        $request->file('file')->storeAs(
            'public/photos', $fileNameToSave);

        $photo = new Photo;
        $photo->name = $request->input('name');
        $photo->file_name = $fileNameToSave;
        $photo->public = $request->input('public') === 'public';
        $photo->user_id = auth()->user()->id;

        $photo->save();

        return redirect()->action('PhotoController@index')->with('success', 'Photo saved');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      $userId = auth()->user()->id;
      $user = User::find($userId);
      $photos = $user->photos;

      $photo = $photos->find($id);

      if(Storage::delete('public/photos/'.$photo->file_name)){
        $photo->delete();

        return redirect()->action('PhotoController@index')->with('success', 'Photo Deleted');
      }
    }
}
