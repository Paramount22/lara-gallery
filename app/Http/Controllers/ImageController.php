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
        $this->middleware('auth')->only('create', 'store', 'update', 'destroy');
    }

    private $imageBasePath = 'images';

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('images.index', [
           // 'images' => Image::latest()->with('user', 'likes', 'unlikes', 'comments')->paginate(9) // eager loading
            'images' => Image::latest()->simplePaginate(9)
        ]);


    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        //dd($image = Image::findOrFail($id)->comments()->paginate(10));
      return view('images.show',
         ['image' => Image::findOrFail($id)])->with('comments', 'comments.user');

    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('images.create');
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

        return redirect()->route('posts')->with('flash', 'Posted');
    }

    /**
     * @param $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $image = Image::findOrFail($id);
        $this->authorize('update', $image);
        return view('images.edit')->with( compact('image') );
    }

    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'description' => 'required|max:50',
            'image' => 'mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        $image = Image::findOrfail($id);

        $this->authorize('update', $image);

        $image->update($request->all());

        $image->file_name = $this->addRemoveImage($request, $image->file_name);

        $image->save();

        return redirect()->route('posts.show', $image->id);
    }

    public function destroy($id)
    {
        $image = Image::findOrFail($id);
        $this->removeImageFromDisk($image->file_name);
        $this->authorize('update', $image);
        $image->delete();

        return redirect('/')->with('flash', 'Post deleted');

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
