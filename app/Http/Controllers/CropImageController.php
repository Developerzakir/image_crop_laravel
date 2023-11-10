<?php
  
namespace App\Http\Controllers;
  
use Illuminate\Http\Request;
use Illuminate\View\View;
use Illuminate\Http\RedirectResponse;
use App\Models\Media;
  
class CropImageController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(): View
    {
        return view('cromImage');
    }
        
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
                'image_base64' => 'required',
            ]);
      
        $input['name'] = $this->storeBase64($request->image_base64);
        Media::create($input);
            
        return back()->with('success', 'Image uploaded successfully.');
    }
    /**
     * Write code on Method
     *
     * @return response()
     */
    private function storeBase64($imageBase64)
    {
        list($type, $imageBase64) = explode(';', $imageBase64);
        list(, $imageBase64)      = explode(',', $imageBase64);
        $imageBase64 = base64_decode($imageBase64);
        $imageName= time().'.png';
        $path = public_path() . "/uploads/" . $imageName;
  
        file_put_contents($path, $imageBase64);
          
        return $imageName;
    }
}