<?php

namespace App\Http\Controllers;

use App\Http\Requests\AboutUsRequest;
use Illuminate\Support\Facades\Storage;
use App\Models\About;

class AboutController extends Controller
{
    public function index()
    {
        $about = About::first();
        return view('abouts.index', compact('about'));
    }
    public function update(AboutUsRequest $request, About $about)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($about->image);
            $data['image'] = $request->file('image')->store('about_descriptions', 'public');

        }
        About::UpdateOrCreate(
            ['id' => 1],
            $data
        );


        return to_route('abouts.index')->with('success', 'About Us Updated Successfully');
    }
}