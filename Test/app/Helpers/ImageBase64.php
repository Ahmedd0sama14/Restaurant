<?php

namespace App\Helpers;
    
function ImageBase64(Request $request)
{
    if ($request->hasFile('photo')) {
        //handle jpeg,svg,png image types here
        //this check assumes your
        //client sends the image with the key photo
    }
    else {
        //handle base64 encoded images here
        $name = Str::random(15) . '.png';
        // decode the base64 file
        $file = base64_decode(preg_replace(
            '#^data:image/\w+;base64,#i',
            '',
            $request->input('photo')
        ));
        Storage::put($name, $file);
        Storage::put($name, $file);

        //to stream the upload with putFileAs or putFile,
        //a resource of Illuminate\Http\File or //Illuminate\Http\UploadedFile type is required
        $file = new File(public_path($name));
        $response = Storage::disk('s3')
            ->putFileAs('images', $file, $name);
        if ($response) {
            //clean up local storage before response
            Storage::delete($name);
            return response()->json(
                [
                    'message' => 'File uploaded',
                    'data' => ['file' => $response]
                ]
            );
        } else {
            return response()->json(['message' => 'Error uploading File', 'data' => ['file' => $response]], 400);
        }
    }
}
