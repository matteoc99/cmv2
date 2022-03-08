<?php

namespace App\Policies;

use App\Models\Document;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;
use Illuminate\Support\Facades\Auth;

class DocumentPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    public function createDocument(User $user)
    {

        if(!$user->isAdmin())
            return Response::deny('');
        $cons = $user->administrates()->get();
        $totalSize =0;
        foreach ($cons as $con){
            $totalSize+=$con->totalFileSizeOfDocuments();
        }
        return  $user->subscription()->plan()->can_documents && $user->subscription()->plan()->max_gb>$totalSize/1000000000
            ? Response::allow()
            : Response::deny('');
    }

    public function createFolder(User $user)
    {

        return $user->isAdmin()
            ? Response::allow()
            : Response::deny('');
    }

    public function moveDocument(User $user, Document $document)
    {
        return $user->isAdmin()
            &&
            !is_null($user->administrates()->where("id", "=", $document->condominium_id)->get()->first())
            ? Response::allow()
            : Response::deny('');
    }

    public function moveDocumentWithParent(User $user, Document $document, Document $parent)
    {
        return $user->isAdmin()
        &&
        !is_null($user->administrates()->where("id", "=", $document->condominium_id)->get()->first())
        &&
        (
            is_null($parent)||
            !is_null($user->administrates()->where("id", "=", $parent->condominium_id)->get()->first())
        )
            ? Response::allow()
            : Response::deny('');
    }

    public function showFolder(User $user, Document $document)
    {
        return $user->isAdmin()||$user->isUser()
            ? Response::allow()
            : Response::deny('');

    }

    public function remove(User $user, Document $document)
    {
        return Auth::user()->isAdmin()&& !is_null(Auth::user()->administrates()->where("id", "=", $document->condominium_id)->get()->first())
            ? Response::allow()
            : Response::deny('');

    }
}
