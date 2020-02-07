<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Exports\UsersExport;
use App\Imports\UsersImport;
use Maatwebsite\Excel\Facades\Excel;

class LaravelExcelController extends Controller
{
    public function import(Request $request) {
        $request->validate([
            'file' => 'required',
        ]);

        if($request->hasFile('file')) {
            Excel::import(new UsersImport, $request->file);
            return redirect('/')->with('message', 'All good!');
        }
    }

    public function export() {
        return Excel::download(new UsersExport, 'users.xlsx');
    }
}