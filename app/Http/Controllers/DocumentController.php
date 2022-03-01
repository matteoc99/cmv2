<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class DocumentController extends Controller
{

    public function showFolder(Condominium $condominium,Document $document){
        $docs = Document::where("condominium_id","=",$condominium->id)->where("parent_id","=",$document->id)->orderBy("isFolder","desc")->orderBy("name","asc")->get();
        return view("folder",["docs"=>$docs,"condominium"=>$condominium,"folder"=>$document]);
    }
    public function show(Condominium $condominium)
    {
        $docs = Document::where("condominium_id","=",$condominium->id)->where("parent_id","=",null)->orderBy("isFolder","desc")->orderBy("name","asc")->get();
        return view("documents",["docs"=>$docs,"condominium"=>$condominium]);
    }

    public function addFolder(Request $request)
    {
        $request->validate([
            "name" => "required",
        ]);
        $condominium_id = json_decode($request->get("condominium_id"))->id;
        $parent_id=null;
        if(!is_null($request->get("parent_id"))){
            $parent_id = json_decode($request->get("parent_id"))->id;
        }
        $doc = new Document();
        $doc->isFolder = true;
        $doc->name = $request->get("name");
        $doc->condominium_id = $condominium_id;
        $doc->parent_id = $parent_id;
        $doc->save();
        return redirect()->back();
    }

    public function addDocument(Request $request)
    {
        $request->validate([
            'documents' => 'required',
            'documents.*' => 'required'

        ]);
        $condominium_id = json_decode($request->get("condominium_id"))->id;

        $con = Condominium::where("id","=",$condominium_id)->get()->first();

        $parent_id=null;
        if(!is_null($request->get("parent_id"))){
            $parent_id = json_decode($request->get("parent_id"))->id;
        }

        if (!file_exists(public_path('uploads/'.$con->uuid."/"))) {
            mkdir(public_path('uploads/'.$con->uuid."/"), 0777, true);
        }

        if($request->hasfile('documents'))
        {
            foreach($request->documents as $file)
            {
                $doc = new Document();
                $doc->condominium_id = $condominium_id;
                $doc->name = $file->getClientOriginalName();
                $doc->parent_id = $parent_id;

                $uuid = Str::uuid()->toString();
                $ext = $file->extension();

                $fileName = $uuid . '.' . $ext;
                $file->move(public_path('uploads/'.$con->uuid."/"), $fileName);
                $doc->uuid = $uuid;
                $doc->mime_type = $ext;
                $doc->save();
            }
        }

        return redirect()->back();
    }
}
