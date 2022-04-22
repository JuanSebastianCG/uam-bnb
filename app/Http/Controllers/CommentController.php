<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use App\Http\Traits\QueryTrait;
use App\Models\Property;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CommentRequest;

class CommentController extends Controller
{

    use QueryTrait;

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user = Auth()->user();
        $comments =  DB::table('comments')->where('user_id', '=', $user->id)->simplePaginate(4);

        $properties = collect(new Property);
        foreach ($comments as $comment) {
            $properties->push(Property::find($comment->property_id));
        }

        return view('comment.index', compact('comments', 'properties'));
    }

    public function allComments($properties_id)
    {
        $comments = $this->listOfComments($properties_id);
        return response()->json($comments);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->text == null) {
            return response()->json(['success'=>'No puede colocar campos vacios']);
        }
        $coment = new Comment();
        $coment->user_id = request()->user['id'];
        $coment->property_id = request()->property['id'];
        $coment->text =request()->text ;
        $coment->save();
        return response()->json(['success'=>'exito']);

    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function update($comment, Request $request)
    {


        if ($request->text == null) {
            return response()->json(['success'=>'no puede colocar campos vacios']);
        }
        $commentEdit = Comment::find($comment);
        $commentEdit->text = $request->text;
        $commentEdit->save();

        return response()->json(['success'=>'exito']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Comment  $comment
     * @return \Illuminate\Http\Response
     */
    public function destroy($comment, Request $request)
    {

        $qualification = Comment::find($comment)->delete();
        if ($qualification) {
            return response()->json(['success'=>'exito']);
        }else {
            return response()->json(['success'=>'no se elimino nada']);
        }
    }
}
