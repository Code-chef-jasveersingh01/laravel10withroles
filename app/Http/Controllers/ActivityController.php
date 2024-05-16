<?php

namespace App\Http\Controllers;

use App\Models\Audit;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ActivityController extends Controller
{
   /*
   * Get the audit data for the admin view
   *
   * return array;
   *
   */

   public function auditLogs()
   {
     try{

       return view('admin.audit.audit-list');
     }catch (\Exception $e){
       Log::error('####### ManageUserController -> auditLogs() #######  ' . $e->getMessage());
           Session::flash('alert-error', __('message.something_went_wrong'));
           return redirect()->back();
     }

   }

   /*
   * Send the data back to the data table for activity log
   *
   *
   */

   public function dataTableActivityListTable(Request $request)
   {
     if (!in_array(Auth::user()->user_type, [1]) || !auth_permission_check('View All Admin')) return Datatables::of([])->make(true);

       #main query
       $query  = Audit::with('user');

       #search_key filter
       if (isset($request->filterSearchKey) && !empty($request->filterSearchKey)) {
           $query->where(function ($query) use ($request) {
               $query->where('event', 'like', '%' . $request->filterSearchKey . '%');
           });
       }

       $query = $query->orderBy('created_at', 'desc');

       return DataTables::of($query)
               ->addColumn('user_name', function ($audit) {
                 return ucfirst($audit->user->name);
                 })
               ->addColumn('user_email', function ($audit) {
                   return $audit->user->email;
               })->make(true);
   }
}
