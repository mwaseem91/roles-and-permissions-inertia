<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function fileUpload(Request $request)
    {
        $request->validate([
            'file.*' => 'required|file',
        ]);
    
        try {
            $userId = Auth::user()->id;
    
            $files = $request->file('file');
    
            foreach ($files as $file) {
    
                $encryptedContents = Crypt::encrypt(file_get_contents($file));
    
                $encryptedFileName = 'encrypted_' . $file->getClientOriginalName();
    
                $path = Storage::putFileAs('files/' , $encryptedFileName, $encryptedContents);
    
                // Save metadata in the database
                Attachment::create([
                    'file_path' => $path,
                    'user_id' => $userId,
                    'file_name' => $file->getClientOriginalName(),
                ]);
            }
    
            return response()->json('Files uploaded successfully', 200);
    
        } catch (\Exception $e) {
            return response()->json($e->getMessage(), 500);
        }
    }
    
}
