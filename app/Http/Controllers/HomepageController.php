<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Carbon\Carbon;

use Illuminate\Http\Request;

class HomepageController extends Controller
{
    protected $file_location = 'assets/home';

    private function imageUpload($files, $old_files = null)
    {
        if (!empty($files)) {
            // Insert new File/Data
            $uploadedFile = $files;
            $filename = 'home-' . (Carbon::now()->timestamp + rand(1, 1000));
            $fullname = $filename . '.' . strtolower($uploadedFile->getClientOriginalExtension());
            $filesize = $uploadedFile->getSize();
            $path = $uploadedFile->storeAs($this->file_location, $fullname);

            if (!empty($old_files)) {
                \Storage::delete($this->file_location . '/' . $old_files);
            }

            return $fullname;
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data = Files::all();
        return view('welcome', [
            'data' => $data
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => ['required', 'mimes:jpg,jpeg,png', 'max:2000'],
        ], [
            'image.required' => "Field Image Wajib Diisi!",
            'image.mimes' => "File pada Field Image Menggunakan Format yang Tidak Didukung!",
            'image.max' => "File pada Field Image Melebihi Batas Upload (2000kb)!",
        ]);

        $image = $this->imageUpload($request->image);

        $data = new Files;
        $data->filename = $image;
        $data->save();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Data Fetched'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $data = Files::findOrFail($id);
        \Storage::delete($this->file_location.'/'.$data->filename);
        $data->delete();

        return redirect()->back()->with([
            'status' => 'success',
            'message' => 'Data Deleted | '.$id
        ]);
    }
}
