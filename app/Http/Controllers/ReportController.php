<?php

namespace App\Http\Controllers;

use App\Models\Report;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function show($id)
    {
        $report = Report::find($id);

        if (!$report) {
            return response()->json(['message' => 'Report not found'], 404);
        }

        return response()->json($report);
    }
}




// namespace App\Http\Controllers\Admin;

// use App\Models\Admin\Blog;
// use App\Http\Controllers\Controller;
// use Illuminate\Support\Facades\Log;
// use Illuminate\Http\Request;

// class BlogController extends Controller
// {
//     /**
//      * Display a listing of the resource.
//      */
//     public function index()
//     {
//         return view('admin.blog.blog', [
//             'title' => 'Blog',
//     ]);
//     }

//     /**
//      * Show the form for creating a new resource.
//      */
//     public function create()
//     {
//         //
//     }

//     /**
//      * Store a newly created resource in storage.
//      */
//     public function store(Request $request)
//     {
//         echo (string)$request->input('avatar')."<br>";
//         echo(string)$request->input('blog_name');
//         echo(string)$request->input('blog_Description');

//             try {
//                     Blog::create([
//                         'BlogAvatar' => (string)$request->input('avatar'),
//                         'Name' => (string)$request->input('blog_name'),
//                         'Description' => (string)$request->input('blog_Description'),
//                     ]);
//                     return redirect()->back();

//             } catch (\Throwable $th) {
//                 Log::info($th->getMessage());
//                 return redirect()->back()->with('errorInsertCategory', 'Thêm Ảnh thất bại vui lòng thử lại sau');
//             }
//     }

//     /**
//      * Display the specified resource.
//      */
//     public function show(string $id)
//     {
//         $listblogs = Blog::where('BlogID', $id)->first();
//         return view('admin.blog.editblog', [
//             'title'=> 'List Blog', 
//             'listblogs'=>$listblogs,
//         ]);

//     }
//     public function showViewListBlog()
//     { 
//         $listblogs = Blog::get();
//         return view('admin.blog.listblog', [
//             'title'=> 'List Blog', 
//             'listblogs'=>$listblogs,
//         ]);
//     }
//     /**
//      * Show the form for editing the specified resource.
//      */
//     public function edit(string $id)
//     {
//         //
//     }

//     /**
//      * Update the specified resource in storage.
//      */
//     public function update(Request $request, string $id)
//     {
//         $imagePath = $request->thumb;
//         $pathInfo = pathinfo($imagePath);
//         $filenameWithExtension = $pathInfo['filename'] . '.' . $pathInfo['extension'];
//             try {
//                 Blog::where('BlogID', (int)$id)->update([
//                         'BlogAvatar' => (string) "$filenameWithExtension",
//                         'Name' => (string)$request->input('blog_name'),
//                         'Description' => (string)$request->input('blog_Description'),
//                     ]);
//                     return redirect()->route('listblog');

//             } catch (\Throwable $th) {
//                 Log::info($th->getMessage());
//                 return redirect()->back()->with('errorInsertCategory', 'Thêm Ảnh thất bại vui lòng thử lại sau');
//             }
//     }

//     /**
//      * Remove the specified resource from storage.
//      */
//     public function destroy(Request $request)
//     {      
//         $id = (int)$request->input('id');
//         $result = Blog::where('BlogID', $id)->first();
        
//         if ($result) {
//             Blog::where('BlogID', $id)->delete();
//             return response()->json([
//                 'error' => false
//             ]);
//         }
    
//         return response()->json([
//             'error' => true
//         ]);
//     }
// }
