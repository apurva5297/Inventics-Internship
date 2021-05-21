<?php
namespace App\Traits;
trait imageTrait
{
//to upload image
    public function uploadImage($image,$folder){

      $this->validate($request, [
        'file' => 'required|image|mimes:jpeg,png,jpg,bmp,gif,svg|max:2048',
      ]);
      if ($request->hasFile('file')) {
        $image = $request->file('file');
        $name = time().'.'.$image->getClientOriginalExtension();
        $destinationPath = public_path('/images/$folder/');
        $image->move($destinationPath, $name);
        $this->save();
        return back()->with('success','Image Upload successfully');
      }
}
public function deleteImage($image,$folder)
{
    $filename = public_path() . '/images'.'/' . $folder.'/' . $image;

    unlink($filename);

}
}