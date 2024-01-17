<?php
namespace App\Traits ;

use Illuminate\Http\Request;

trait ImageTrait{
    public function verifyAndUpload(Request $request , $fieldName = 'image' , $directory = 'images'){
        if( $request->hasFile( $fieldName ) ){
            $imageName = uniqid() . $request->file($fieldName)->getClientOriginalName();
            $request->file($fieldName)->move(public_path($directory), $imageName);
            return $imageName;
        }
    }
}
