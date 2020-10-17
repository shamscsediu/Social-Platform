<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Propic;
use App\User;
use File;
class FileUploadController extends Controller
{
    public function pro_store(Request $request)
    {
        $this->validate($request, [
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:50000', //only allow this type extension file.
        ]);
        $user = Auth::user();
        $prefilename = public_path('storage/').$user->image;
        if(File::exists($prefilename)) {   
            unlink($prefilename);     
        }
        $extension = $request->pr->extension();
        $filename = $user->id.'pro.'.$extension;
        $prefilename = $user->id.'pro';
        $path = $request->pr->storeAs('images',$filename);    
        $user->image = $path;
        $user->save();            
      /* $fileupload = new FileUpload;
        $fileupload->filename=$fileName;
        $fileupload->save();*/
 		//return $userId;
        return response()->json(['success'=>'File Uploaded Successfully']);
    }
}
