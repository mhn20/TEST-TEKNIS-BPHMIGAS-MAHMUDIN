<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\DataWebsite;
use App\Models\Article;

class ArticlesController extends Controller
{
    public function index(Request $req){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Data Articles";
        $object_data['datawebsite'] = $datawebsite;
        return view('panel.pages.articles.index',$object_data);
    }

    public function postData(Request $req){
        $object_data = [
            'title' => $req->title, 'description' => $req->description, 'publisher' => $req->publisher, 'content' => $req->content
        ];
        $save_images = null;
        try {
            $required_ext = 'jpg,jpeg,png';
            if($req->hasFile('images')) {
                if (str_contains($required_ext, @$req->images->extension())) { 
                    $name_images = strtolower('images_'.time().'.'.@$req->images->extension());  
                    $validate_images = $req->validate([
                        'images' => 'max:500',
                    ]);
                    $req->images->move(public_path('upload/articles'), $name_images);
                    $save_images = '/upload/articles/'.$name_images;
                    $object_data['images'] = $save_images;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'images Harus format :'.$required_ext
                    ]);
                }
            }
        } catch (\Exception $e_images) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 500kb'
            ]);
        }

        
        Article::create($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_images' => @$save_images
        ]);
        
    }

    public function data(Request $req){

        $search = $req->get('search');

        $dataset = new Article;

        if($search){
            $dataset = $dataset->where(function($query) use ($search){
                $query->orWhere('title','LIKE','%'.$search.'%')
                    ->orWhere('description','LIKE','%'.$search.'%')
                    ->orWhere('publisher','LIKE','%'.$search.'%');
            });
        }

        $dataset = $dataset->orderBy('id','DESC');

        $dataset = $dataset->paginate(25);

        return response()->json($dataset);

    }

    public function getContent(Request $req, $id){
        $dataset = Article::where('id',$id)->first();
        return response()->json($dataset);
    }

    public function editData(Request $req, $id){
        $object_data = [
            'title' => $req->title, 'description' => $req->description, 'publisher' => $req->publisher, 'content' => $req->content
        ];
        $save_images = null;
        try {
            $required_ext = 'jpg,jpeg,png';
            if($req->hasFile('images')) {
                if (str_contains($required_ext, @$req->images->extension())) { 
                    $name_images = strtolower('images_'.time().'.'.@$req->images->extension());  
                    $validate_images = $req->validate([
                        'images' => 'max:500',
                    ]);
                    $req->images->move(public_path('upload/articles'), $name_images);
                    $save_images = '/upload/articles/'.$name_images;
                    $object_data['images'] = $save_images;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'images Harus format :'.$required_ext
                    ]);
                }
            }
        } catch (\Exception $e_images) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 500kb'
            ]);
        }
        
        Article::where('id',$id)->update($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_images' => @$save_images
        ]);
        
    }

    public function deleteData(Request $req, $id){
        Article::where('id',$id)->delete();
        $object_data = [];
        $object_data['status'] = 200;
        $object_data['messages'] = "Delete Successfull";
        return response()->json($object_data);
    }

}
