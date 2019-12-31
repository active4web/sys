<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Models\HomeModel;


use Illuminate\Pagination\LengthAwarePaginator;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */



    public function index()
    {
        return View("pages.home");
    }

    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $string=$request->input('str');
        $validatedData = $request->validate(['str' => 'required|max:255',]);
        $indexes=0;
        foreach(array_unique(str_split($string)) as $letter){
            $indexes++;$count = 0;$before = '';$after = '';$maxdistance = null;
            foreach(str_split($string) as $i=>$l){
                if($l === $letter){
                    $count++;
                    if(($i+1)<count(str_split($string))){
                    $before = ($before!=''?$before.',':'').str_split($string)[$i+1]?:'none';
                    }else{$before  ="none";}
                    if($i>0){
                    $after  = ($after!=''?$after.',':'').str_split($string)[$i-1]?:'none';
                    }
                    else{$after  ="none";}
                    $maxdistance = $count > 1?$i-array_search($l,str_split($string))-1:null;
                }
            }
            echo $letter.' :'.$count.': before :('.$before.') after : ('.$after .')'.($count>1?' :max-distance: ':'').$maxdistance.'</br>';
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
        //
    }
}
