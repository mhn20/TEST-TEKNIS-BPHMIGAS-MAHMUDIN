<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request; 
use App\Models\DataWebsite;
use App\Models\Article;
use App\Models\Contact;

class ContactsController extends Controller
{
    public function index(Request $req){
        $datawebsite = DataWebsite::first();
        $object_data = [];
        $object_data['page_title'] = "Data Contacts";
        $object_data['datawebsite'] = $datawebsite;
        return view('panel.pages.contacts.index',$object_data);
    }

    public function data(Request $req){

        $search = $req->get('search');

        $dataset = new Contact;

        if($search){
            $dataset = $dataset->where(function($query) use ($search){
                $query->orWhere('nama','LIKE','%'.$search.'%')
                    ->orWhere('email','LIKE','%'.$search.'%')
                    ->orWhere('keterangan','LIKE','%'.$search.'%');
            });
        }

        $dataset = $dataset->orderBy('id','DESC');

        return response()->json($dataset->paginate(25));

    }

    public function deleteData(Request $req, $id){
        Contact::where('id',$id)->delete();
        $object_data = [];
        $object_data['status'] = 200;
        $object_data['messages'] = "Delete Successfull";
        return response()->json($object_data);
    }

}
