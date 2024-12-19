<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\DataWebsite;
use App\Models\Article;
use App\Models\Video;

class VideosController extends Controller
{
    public function index(Request $req){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Data Videos";
        $object_data['datawebsite'] = $datawebsite;
        return view('panel.pages.videos.index',$object_data);
    }

    public function postData(Request $req){
        $object_data = [
            'title' => $req->title, 'url_youtube' => $req->url_youtube
        ];
        Video::create($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull'
        ]);
        
    }

    public function data(Request $req){

        $search = $req->get('search');

        $dataset = new Video;

        if($search){
            $dataset = $dataset->where(function($query) use ($search){
                $query->orWhere('title','LIKE','%'.$search.'%')
                    ->orWhere('url_youtube','LIKE','%'.$search.'%');
            });
        }

        $dataset = $dataset->orderBy('id','DESC');

        return response()->json($dataset->paginate(25));

    }

    public function editData(Request $req, $id){
        $object_data = [
            'title' => $req->title, 'url_youtube' => $req->url_youtube
        ];
        Video::where('id',$id)->create($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull'
        ]);
        
    }

    public function deleteData(Request $req, $id){
        Video::where('id',$id)->delete();
        $object_data = [];
        $object_data['status'] = 200;
        $object_data['messages'] = "Delete Successfull";
        return response()->json($object_data);
    }

}
