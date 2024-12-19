<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\DataWebsite;
use App\Models\Asset;
use App\Models\User;
use App\Models\Artist;

class AssetsController extends Controller
{
    public function index(Request $req){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Data Assets";
        $object_data['datawebsite'] = $datawebsite;
        $datauser = User::where('email',session()->get('login_panel')['email'])->first();
        $object_data['datauser'] = $datauser;
        return view('panel.pages.assets.index',$object_data);
    }

    public function postData(Request $req){

        $datauser = User::where('email',session()->get('login_panel')['email'])->first();

        $object_data = [
            'users_id' => $datauser->id,
            'isrc' => $req->isrc,
            'link_youtube_official' => $req->link_youtube_official, 'link_youtube_others' => $req->link_youtube_others, 
            'link_audio' => $req->link_audio, 'link_lainnya' => $req->link_lainnya
        ];
        $save_cover_art = null;
        try {
            $required_ext = 'jpg,jpeg,png';
            if($req->hasFile('cover_art')) {
                if (str_contains($required_ext, @$req->cover_art->extension())) { 
                    $name_cover_art = strtolower('cover_art_'.time().'.'.@$req->cover_art->extension());  
                    $validate_cover_art = $req->validate([
                        'cover_art' => 'max:500',
                    ]);
                    $req->cover_art->move(public_path('upload/assets'), $name_cover_art);
                    $save_cover_art = '/upload/assets/'.$name_cover_art;
                    $object_data['cover_art'] = $save_cover_art;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'cover_art Harus format :'.$required_ext
                    ]);
                }
            }else{
                $object_data['cover_art'] = '/upload/assets/sample_1.jpg';
            }
        } catch (\Exception $e_cover_art) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 500kb'
            ]);
        }

        
        $dataset = Asset::create($object_data);

        $artist_name = $req->input('artist_name');
        $url = $req->input('url');
        foreach($artist_name as $key => $value){
            Artist::create([
                'assets_id' => $dataset->id, 'artist_name' => $artist_name[$key], 'url' => $url[$key]
            ]);
        }

        error_log('dataset : '.$dataset);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_cover_art' => @$save_cover_art
        ]);
        
    }

    public function data(Request $req){

        $search = $req->get('search');

        $dataset = Asset::with('user');

        if($search){
            $dataset = $dataset->where(function($query) use ($search){
                $query->orWhere('isrc','LIKE','%'.$search.'%')
                    ->orWhere('link_youtube_official','LIKE','%'.$search.'%')
                    ->orWhere('link_youtube_others','LIKE','%'.$search.'%')
                    ->orWhere('link_audio','LIKE','%'.$search.'%')
                    ->orWhere('link_lainnya','LIKE','%'.$search.'%');
            });
        }

        $dataset = $dataset->orderBy('id','DESC');

        $dataset = $dataset->paginate(25);
        foreach($dataset as $rowindex){
            $dataartists = Artist::
            $rowindex->test = "oke";
        }

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
        $save_cover_art = null;
        try {
            $required_ext = 'jpg,jpeg,png';
            if($req->hasFile('cover_art')) {
                if (str_contains($required_ext, @$req->cover_art->extension())) { 
                    $name_cover_art = strtolower('cover_art_'.time().'.'.@$req->cover_art->extension());  
                    $validate_cover_art = $req->validate([
                        'cover_art' => 'max:800|image|dimensions:max_width=3000,max_height=3000',
                    ]);
                    $req->cover_art->move(public_path('upload/assets'), $name_cover_art);
                    $save_cover_art = '/upload/assets/'.$name_cover_art;
                    $object_data['cover_art'] = $save_cover_art;                    
                }else{
                    return response()->json([
                        'status' => 500, 'messages' => 'cover_art Harus format :'.$required_ext
                    ]);
                }
            }
        } catch (\Exception $e_cover_art) {
            return response()->json([
                'status' => 500, 'messages' => 'Size Maksimal 800Kb Dimensi 3000x3000 Pixels'
            ]);
        }
        
        Article::where('id',$id)->update($object_data);
        return response()->json([
            'status' => 200, 'messages' => 'Save Successfull', 'save_cover_art' => @$save_cover_art
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
