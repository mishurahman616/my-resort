<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Http\Middleware\adminAuthCheck;
use App\Models\Admin\Admin;
use App\Models\Admin\Resort;
use App\Models\Admin\ResortImages;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    function index(){
        $totalAdmin=Admin::count();
        $totalResort=Resort::count();
        $totalResortImages=ResortImages::count();

        $summary=array(
            'admin'=>$totalAdmin, 
            'resort'=>$totalResort, 
            'resortImage'=>$totalResortImages, 

        );

        return view('admin/homePage', ['summary'=>$summary]);
    }
    function loginPage(){
         return view('admin/loginPage');
    }
    function login(Request $request){
        $request->validate([
            'email' => 'required|email|min:5|max:100',
            'password' => 'required|min:6|max:50',
        ]);

        $admin = Admin::where('email', '=', $request->email)->first();
        if($admin){
            if(Hash::check( $request->password, $admin->password)){
                session(['adminId'=>$admin->id]);
                return redirect('admin/dashboard')->with('success', 'Login Successful');
            }else{
                return back()->with('fail', 'Email or Password mismacthed');
            }
        }else{
            return back()->with('fail', 'Invalid Email or Password');
        }
    }
    function createAdmin(){
        return view ('admin/createAdminPage');
    }
    function addAdmin(Request $request){
        $request->validate([
            'name' => 'required|string|min:2|max:200',
            'email' => 'required|email|unique:admins|min:5|max:255',
            'mobile' => 'required|unique:admins|min:11|max:13',
            'address' => 'string',
            'password' => 'required|min:6|max:100',

        ]);
  
            $admin = new Admin();
            $admin->name=$request->name;
            $admin->email=$request->email;
            $admin->mobile=$request->mobile;
            $admin->address=$request->address;
            $admin->password=Hash::make($request->password);
            $admin->addedByAdmin=$request->session()->get('adminId');
            $admin->created_at = Carbon::now()->timezone('Asia/Dhaka')->format('Y-m-d H:i:s');
            $admin->updated_at = Carbon::now()->timezone('Asia/Dhaka')->format('Y-m-d H:i:s');
            $result = $admin->save();
            if($result){
                return back()->with('success', 'Admin Added successfully!');
            }else{
                return back()->with('fail', 'Someting went wrong!');
            }
    }

    function viewAdmins(){

        return view('admin.viewAdminPage');
    }

    function getAdminsData(Request $request){
        $draw = $request->get('draw'); 
        $start = intval($request->get('start')); 
        $rowPerPage = intval($request->get("length"));
        $orderArray = $request->get('order'); 
        $columnNameArray = $request->get('columns'); 
        $searchArray = $request->get('search'); 
        $columnIndex = $orderArray[0]['column']; 
        $columnName = $columnNameArray[$columnIndex]['data']; 
        $columnSortOrder = $orderArray[0]['dir']; 
        $searchValue = $searchArray['value']; 
        
        $total = Admin::all()->count();
        $totalFilter = Admin::where('name', 'like', "%".$searchValue."%")
                            ->orWhere('email', 'like', "%".$searchValue."%")
                            ->orWhere('mobile', 'like', "%".$searchValue."%")
                            ->orWhere('address', 'like', "%".$searchValue."%")
                            ->orWhere('addedByAdmin', 'like', "%".$searchValue."%")
                            ->orWhere('created_at', 'like', "%".$searchValue."%")
                            ->orderBy($columnName, $columnSortOrder)
                            ->get(['id', 'name', 'email', 'mobile', 'address', 'addedByAdmin', 'created_at'])->count();
                        
        $arrData = Admin::where('name', 'like', "%".$searchValue."%")
                        ->orWhere('email', 'like', "%".$searchValue."%")
                        ->orWhere('mobile', 'like', "%".$searchValue."%")
                        ->orWhere('address', 'like', "%".$searchValue."%")
                        ->orWhere('addedByAdmin', 'like', "%".$searchValue."%")
                        ->orWhere('created_at', 'like', "%".$searchValue."%")
                        ->orderBy($columnName, $columnSortOrder)
                        ->skip($start)->take($rowPerPage)->get(['id', 'name', 'email', 'mobile', 'address', 'addedByAdmin', 'created_at']);


        foreach($arrData as $admin){
            if($admin->addedByAdmin >0){
                $admin->addedByAdmin=Admin::find($admin->addedByAdmin)->email;
            }else{
                $admin->addedByAdmin="Default";
            }
        }
        
        $response = array(
            'draw' =>intval($draw),
            'recordTotal' => $total,
            'recordsFiltered' => $totalFilter,
            'data' => $arrData,
        );
        return response()->json($response);
    }

    function logout(Request $request){
        $request->session()->flush('adminId', '');
        return redirect('admin/login');
    }
}
