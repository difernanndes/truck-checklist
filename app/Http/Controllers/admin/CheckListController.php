<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CheckListController extends Controller
{
    public function __construct() {
        $this->middleware('auth');
        $this->middleware('can:edit-driver');
    }

    public function index() {
        return view('admin.checklist.index');
    }
}
