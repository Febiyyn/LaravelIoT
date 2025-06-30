<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ArticleController extends Controller
{
    public function index(){
        $sort = request('sort');
        return "Halaman Artikel ". $sort;
    }

    public function show($slug){
        return "Halaman Detail Artikel ". $slug;
    }
}
