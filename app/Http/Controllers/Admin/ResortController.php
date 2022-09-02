<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Admin\Resort;
use App\Models\Admin\ResortImages;
use Carbon\Carbon;
use Illuminate\Http\Request;

class ResortController extends Controller
{
    function index(){
    //    $resots = Resort::all()->images;
        return view('admin.resortPage');
    }

    function createResort(){
        return view('admin.createResort');
    }
    function addResort(Request $request){
        $request->validate([
            'type'=> "required|string|max:150",
            'desc'=> "required|string|max:255",
            'room'=> "required|string|max:100",
            'price'=> "required|string|max:100",
        ]);

        $resort = Resort::create([
            'type'=> $request->type,
            'desc'=> $request->desc,
            'room'=> $request->room,
            'price'=> $request->price,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ]);
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $path= $image->store('public/gallery');
                $name=(explode('/', $path))[2];
                $host= $_SERVER['HTTP_HOST'];
                $link='http://'.$host.'/storage/gallery/'.$name;
            ResortImages::create([
                'link'=>$link,
                'resort_id'=>$resort->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        }
        return back()->with('success', 'Resort Added Successfuly');
    }
    function editResortPage($id){
        $resort = Resort::where('id', '=', $id)->first();
        return view('admin.editResortPage', ['resort'=>$resort, 'resortId'=>$id]);
    }
    function editResort(Request $request){
        $request->validate([
            'id'=> "required|string|min:1",
            'type'=> "required|string|max:150",
            'desc'=> "required|string|max:255",
            'room'=> "required|string|max:100",
            'price'=> "required|string|max:100",
        ]);
        $resort = Resort::find($request->id);
        $resort->type= $request->type;
        $resort->desc= $request->desc;
        $resort->room= $request->room;
        $resort->price= $request->price;
        $resort->updated_at = Carbon::now();
        $result = $resort->save();
        if($result){
            return back()->with('success', 'Resort Save Successfuly');

        }else{
            return back()->with('fail', 'Resort Save Failed');

        }
        
    }

    function getResortData(Request $request){
    
        $draw = $request->get('draw'); 
        $start = $request->get('start'); 
        $rowPerPage = $request->get("length");
        $orderArray = $request->get('order'); 
        $columnNameArray = $request->get('columns'); 
        $searchArray = $request->get('search'); 
        $columnIndex = $orderArray[0]['column']; 
        $columnName = $columnNameArray[$columnIndex]['data']; 
        $columnSortOrder = $orderArray[0]['dir']; 
        $searchValue = $searchArray['value']; 
        
        
        $total = Resort::count();
        $arrData = Resort::where('type', 'like', "%".$searchValue."%")
        ->orWhere('desc', 'like', "%".$searchValue."%")
        ->orWhere('room', 'like', "%".$searchValue."%")
        ->orWhere('price', 'like', "%".$searchValue."%")
        ->orWhere('created_at', 'like', "%".$searchValue."%")
        ->orderBy($columnName, $columnSortOrder)
        ->skip($start)->take($rowPerPage)
        ->get(['id', 'type', 'desc', 'room', 'price', 'created_at']);

        $totalFilter = Resort::where('type', 'like', "%".$searchValue."%")
        ->orWhere('desc', 'like', "%".$searchValue."%")
        ->orWhere('room', 'like', "%".$searchValue."%")
        ->orWhere('price', 'like', "%".$searchValue."%")
        ->orWhere('created_at', 'like', "%".$searchValue."%")
        ->orderBy($columnName, $columnSortOrder)
        ->count();
         foreach( $arrData as $resort){
            $resort->images = "<a href='resortImages/".$resort->id."'>images</a>";
            $resort->edit = "<a class='editResortPage' data-id='".$resort->id."' href='editResortPage/".$resort->id."'>edit</a>";
            $resort->delete = "<a class='deleteResort' data-title='".$resort->type."' data-id='".$resort->id."' href='resortDelete?id=".$resort->id."'>delete</a>";
         }
        $response = array(
            'draw' =>intval($draw),
            'recordTotal' => $total,
            'recordsFiltered' => $totalFilter,
            'data' => $arrData,
        );
        return response()->json($response);
    }


    function getResortDataById(Request $request){
        $request->validate([
            'id'=>'required|min:1',
        ]);
        $resort = Resort::find($request->id)->images->get();
        return $resort;
    }
    
    function deleteResort(Request $request){
        $request->validate([
            "id"=>"required|int|min:0"
        ]);
        $deleteId=$request->input('id');
        $result= Resort::find($deleteId)->delete();
        if($result===true){
            return 1;
        }else{
            return 0;
        }
    
    }
    function resortImages($id){
        
        $images = ResortImages::where('resort_id', '=', $id)->get();
        return view('admin.resortImages', ['images'=>$images, 'resortId'=>$id]);
    }

    function deleteResortImage(Request $request){
        $request->validate([
            "id"=>"required|int|min:0"
        ]);
        $deleteId=$request->input('id');
        $result= ResortImages::find($deleteId)->delete();
        if($result===true){
            return 1;
        }else{
            return 0;
        }
    
    }
    function addResortImages(Request $request){
        $id= $request->resort_id;
        if($request->hasFile('images')){
            foreach($request->file('images') as $image){
                $path= $image->store('public/gallery');
                $name=(explode('/', $path))[2];
                $host= $_SERVER['HTTP_HOST'];
                $link='http://'.$host.'/storage/gallery/'.$name;
            ResortImages::create([
                'link'=>$link,
                'resort_id'=>$id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
        }
        return back()->with('success', 'Image(s) Added Successfuly');
    }
}
