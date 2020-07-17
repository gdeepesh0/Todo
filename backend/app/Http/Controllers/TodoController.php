<?php

namespace App\Http\Controllers;

use App\todo;
use Illuminate\Http\Request;

class TodoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(['success'=>true,'data'=>todo::all(),'msg'=>'data retrived successfully'], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([ 'title'=>'required' ]);
        $request->request->add(['status' => 'active']); //add request
        return response()->json(['success'=>true,'data'=>todo::create($request->all()),'msg'=>'To do saved Successfully.'], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function show($todo)
    {
        $data = todo::find($todo);

        if (empty($data)) {
            return response()->json(['success'=>false,'data'=>[],'msg'=>'To do not found.'], 404);
        }
        return response()->json(['success'=>true,'data'=>$data,'msg'=>'To do get successfully.'], 200);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$todo)
    {
        $data = todo::find($todo);

        if (empty($data)) {
            return response()->json(['success'=>false,'data'=>[],'msg'=>'To do not found.'], 404);
        }
        $data->title = $request->title ?? $data->title;
        $data->status = $request->status ?? $data->status;
        $data->save();
        return response()->json(['success'=>true,'data'=>$data,'msg'=>'To do updated successfully.'], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy($todo)
    {
        $data = todo::find($todo);
        if (empty($data)) {
            return response()->json(['success'=>false,'data'=>[],'msg'=>'To do not found.'], 404);
        }
        $data->delete();
        return response()->json(['success'=>true,'data'=>[],'msg'=>'To do deleted successfully.'], 200);
    }
}
