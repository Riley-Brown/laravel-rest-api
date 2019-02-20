<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;
use Validator;

class ItemsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $items = Item::all();
        return response()->json($items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            // required field for api
            'text' => 'required'
        ]);

        if($validator->fails()) {
            // res to send if text field empty
            $request = array('response' => $validator->messages(), 'success' => false);
            return $request;
        } else {
            // create item
            $item = new Item;
            $item->text = $request->input('text');
            $item->body = $request->input('body');

            // save item to DB
            $item->save();

            // returns response to api
            return response()->json($item);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $item = Item::find($id);
        return response()->json($item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
  

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            // required field for api
            'text' => 'required'
        ]);

        if($validator->fails()) {
            // res to send if text field empty
            $request = array('response' => $validator->messages(), 'success' => false);
            return $request;
        } else {
            // find item
            $item = Item::find($id);
            $item->text = $request->input('text');
            $item->body = $request->input('body');

            // update item in DB
            $item->save();

            // returns response to api
            return response()->json($item);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();
        $request = array('response' => 'Item Deleted', 'success' => true);
        return $request;
    }
}