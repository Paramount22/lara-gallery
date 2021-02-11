<?php

namespace App\Http\Controllers;
use App\Image;
use Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class ImageController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->only('create', 'store');
    }

    private $imageBasePath = 'images';

    public function index()
    {
        return view('images.index', [
            'images' => Image::latest()->with('user')->get() // eager loading
        ]);
    }

    public function show($id)
    {
     return view('images.show', ['image' => Image::findOrFail($id)]);
    }

    public function create()
    {
        return view('images.create');
    }

    public function store(Request $request)
    {
       // dd($request);
       $request->validate([
            'description' => 'required|max:50',
            'image' => 'required|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = Auth::user()->images()->create($request->all());

        $image->file_name = $this->addRemoveImage($request, $image->file_name);

        $image->save();

        return redirect()->route('posts');
    }

    /**
     * @param Request $request
     * @param $previousFileName
     * @return |null
     */
    private function addRemoveImage(Request $request, $previousFileName )
    {
        $image = $request->image;

        if($request['remove_image'] && $image == null) {
            $this->removeImageFromDisk($previousFileName);
            return null;
        }

        if($image == null)
            return $previousFileName;

        return $this->uploadImageToDisk($image, $previousFileName);

    }

    /**
     * @param $image
     * @param $previousFileName
     * @return string
     */
    private function uploadImageToDisk($image, $previousFileName)
    {
        $file_name = uniqid() . '-' . $image->getClientOriginalName();
        $this->removeImageFromDisk($previousFileName);
        $image->storeAs($this->imageBasePath, $file_name);

        return $file_name;

    }

    /**
     * @param $file_name
     */
    private function removeImageFromDisk($file_name)
    {
        $fullPath = $this->imageBasePath . DIRECTORY_SEPARATOR . $file_name;
        Storage::delete($fullPath);

    }
}
