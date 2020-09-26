<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use \DB;
use Illuminate\Support\Facades\Schema;

class AjaxController extends BaseController
{
    /**
     * Edit ordering the specified resource from storage.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function orderingEdit(Request $request)
    {
        if ($request->ajax()) {

            DB::table($request->object)
                ->where('id', (int)$request->id)
                ->update(['ordering' => (int)$request->order]);

            $result = ['type' => 'success'];

            return response()->json($result);

        } else {
            return response()->json('error', 404);
        }
    }

    public function transliteTitle(Request $request)
    {
        if ($request->ajax()) {

            $string = trim($request->str);
            $text = \Str::slug($string) . '-' . $request->id;

            return response($text)
                ->header('Content-Type', 'text-plane');

        } else {
            return response()->json('error', 404);
        }
    }
    
    public function checkUniqueAlias(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->id;
            $alias = $request->alias;
            $table = $request->table;
            
            if (Schema::hasTable($table)) {
            
                $existsAlias = DB::table($table)
                    ->where([
                        ['id', '!=', $id],
                        ['alias', '=', $alias],
                    ])
                    ->exists();
                    
                if ($existsAlias) {
                    $result = ['status' => 'error'];
                } else {
                    $result = ['status' => 'success'];
                }
                return response()->json($result);
                
            } else {
                return response()->json('error', 404);
            }

        } else {
            return response()->json('error', 404);
        }
    }

}
