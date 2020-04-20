<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Live_AJAX_Search extends Controller
{
    function index()
    {
     return view('Live_AJAX_Search');
    }
    public function store(Request $request)
 {
        $grocery = new Live_AJAX_Search;
        $grocery->name = $request->name;
        $grocery->city = $request->city;
        $grocery->phone = $request->phone;
        $grocery->zip = $request->zip;
        $grocery->save();
        return response()->json(['success'=>'Data is successfully added']);
 }

    function action(Request $request)
    {
     if($request->ajax())
     {
      $output = '';
      $query = $request->get('query');
      if($query != '')
      {
       $data = Live_AJAX_Search::where('name', 'like', '%'.$query.'%')
         ->orWhere('city', 'like', '%'.$query.'%')
         ->orWhere('phone', 'like', '%'.$query.'%')
         ->orWhere('zip', 'like', '%'.$query.'%')
         ->orderBy('id', 'desc')
         ->get();
         
      }
      else
      {
       $data = Live_AJAX_Search::All()
         ->orderBy('id', 'desc')
         ->get();
      }
      $total_row = $data->count();
      if($total_row > 0)
      {
       foreach($data as $row)
       {
        $output .= '
        <tr>
         <td>'.$row->name.'</td>
         <td>'.$row->city.'</td>
         <td>'.$row->phone.'</td>
         <td>'.$row->zip.'</td>
        </tr>
        ';
       }
      }
      else
      {
       $output = '
       <tr>
        <td align="center" colspan="5">No Data Found</td>
       </tr>
       ';
      }
      $data = array(
       'table_data'  => $output,
       'total_data'  => $total_row
      );

      echo json_encode($data);
     }
    }
}
