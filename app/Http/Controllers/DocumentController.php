<?php

namespace App\Http\Controllers;

use App\Models\Condominium;
use App\Models\Document;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class DocumentController extends Controller
{

    public function showFolder(Condominium $condominium, Document $document)
    {
        if (Auth::user()->cannot("showFolder", $document))
            return response("401", 401);


        $docs = Document::where("condominium_id", "=", $condominium->id)->where("parent_id", "=", $document->id)->orderBy("isFolder", "desc")->orderBy("name", "asc")->get();
        $doc = new Document();
        $doc->name = "...";
        $doc->id = $document->parent_id;
        $doc->isFolder = true;
        $doc->condominium_id = $condominium->id;
        if (count($docs) > 0)
            $docs = $docs->prepend($doc);
        return view("folder", ["docs" => $docs, "condominium" => $condominium, "folder" => $document]);
    }

    public function show(Condominium $condominium)
    {
        if (Auth::user()->cannot("showDocuments", $condominium))
            return response("401", 401);

        $docs = Document::where("condominium_id", "=", $condominium->id)->where("parent_id", "=", null)->orderBy("isFolder", "desc")->orderBy("name", "asc")->get();

        return view("documents", ["docs" => $docs, "condominium" => $condominium]);
    }

    public function moveDocument($con, $document, $parent)
    {


        $doc = Document::where("id", "=", $document)->get()->first();
        $par = null;
        if ($parent > 0) //-2 if moving to root layer
            $par = Document::where("id", "=", $parent)->get()->first();

        if (is_null($par)) {
            if (Auth::user()->cannot("moveDocument", $doc))
                return response("401", 401);
        } else {
            if (Auth::user()->cannot("moveDocumentWithParent", [$doc, $par]))
                return response("401", 401);
        }

        if ($doc->condominium_id == $con && (!is_null($par) && $par->condominium_id == $con)) {
            $doc->parent_id = $parent;
            $doc->save();
        } elseif (is_null($par) && $doc->condominium_id == $con) {
            $doc->parent_id = null;
            $doc->save();
        }
        return redirect()->back();
    }

    public function addFolder(Request $request)
    {

        if (Auth::user()->cannot("createFolder", Document::class))
            return response("401", 401);
        $request->validate([
            "name" => "required",
        ]);
        $condominium_id = json_decode($request->get("condominium_id"))->id;
        $parent_id = null;
        if (!is_null($request->get("parent_id"))) {
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

        if (Auth::user()->cannot("createDocument", Document::class))
            return response("401", 401);
        $request->validate([
            'documents' => 'required',
            'documents.*' => 'required'

        ]);
        $condominium_id = json_decode($request->get("condominium_id"))->id;

        $con = Condominium::where("id", "=", $condominium_id)->get()->first();

        $parent_id = null;
        if (!is_null($request->get("parent_id"))) {
            $parent_id = json_decode($request->get("parent_id"))->id;
        }

        if (!file_exists(public_path('uploads/' . $con->uuid . "/"))) {
            mkdir(public_path('uploads/' . $con->uuid . "/"), 0777, true);
        }

        if ($request->hasfile('documents')) {
            foreach ($request->documents as $file) {
                $doc = new Document();
                $doc->condominium_id = $condominium_id;
                $doc->name = $file->getClientOriginalName();
                $doc->parent_id = $parent_id;

                $uuid = Str::uuid()->toString();
                $ext = $file->extension();

                $fileName = $uuid . '.' . $ext;
                $file->move(public_path('uploads/' . $con->uuid . "/"), $fileName);
                $doc->uuid = $uuid;
                $doc->mime_type = $ext;
                $doc->save();
            }
        }

        return redirect()->back();
    }

    public function delete($condominium, $document)
    {
        $doc = Document::where("id", "=", $document)->get()->first();

        if (Auth::user()->cannot("remove", $doc))
            return response("401", 401);

        if ($doc->condominium_id == $condominium) {
            $doc->recursiveDelete();
        }
        return redirect()->back();
    }
}
