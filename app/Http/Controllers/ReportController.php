<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    public function tags()
    {
        $tags = Tag::withCount('products')->orderBy('products_count', 'desc')->get();
        return view('admin.reports.tags', compact('tags'));
    }
}
