<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;

class ImageController extends Controller
{
    public function index()
    {
        $foto = Image::all();
        return view('image' , compact('foto'));
        
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);
        
        $doc=time().'.'.$request->image->extension();
        $request->file('image')->move(public_path('images'),$doc);

        $data = Image::create([
            'image' => $doc,
        ]);


        return redirect()->route('image.index');
    }

}
