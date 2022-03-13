<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;

use  App\Models\User001;

use Illuminate\Http\Request;
use App\Exports\CustomExportView;

use Maatwebsite\Excel\Facades\Excel;

class submitController extends Controller
{
    //
    public function show()
    {$users = User001::paginate(40);
        return view('index',compact('users'));
    }
    public function export(){
        return Excel::download(new CustomExport(),'users.xlsx');
    }
    public function export_view(){
        return Excel::download(new CustomExportView(),'sponsors.xlsx');
    }
    public function indexSorting()
 {
     $users = User001::sortable()->paginate(40);
 
     return view('indexsort',compact('users'));
 }
 public function indexFiltering(Request $request)
 {
     $filter = $request->query('filter');
 
     if (!empty($filter)) {
         $users = User001::where('email', 'like', '%'.$filter.'%')
             ->paginate(40);
     } else {
         $users = User001::paginate(40);
            
 
     }
 
     return view('index')->with('users', $users)->with('filter', $filter);
 }
 public function indexdateFiltering(Request $request)
 {
     $donate = $request->query('donate');
 
     if (!empty($donate)) {
         $users = User001::where('created_at', 'like', '%'.$donate.'%')
             ->paginate(40);
     } else {
         $users = User001::paginate(40);
            
 
     }
 
     return view('index')->with('users', $users)->with('donate', $donate);
 }
 
}
