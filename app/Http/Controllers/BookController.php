<?php

namespace App\Http\Controllers;

use App\Http\Requests\BookRequest;
use App\Models\Book;
use Exception;
use Illuminate\Http\Request;

class BookController extends Controller
{

    public function index()
    {
        $books=Book::get();
        return view('admin.books.index',compact('books'));
    }

    public function create()
    { 
        $title='Add Book';
        return view('admin.books.add',compact('title'));
    }

   
    public function store(BookRequest $request)
    {
        try{
            $book=new Book;
            $book->title=$request->title;
            $book->auther=$request->auther;
            $book->body=$request->body;
            $book->published_year=$request->published_year;
            $book->save();
            return redirect('admin/books')->with('success_message','Book Added successfully');
        }catch(Exception $e){
            return redirect()->back()->with('erorr_message',$e->getMessage());
        }
       
    }

 
    public function show($id)
    {
        //
    }

 
    public function edit($id)
    {
        $book=Book::find($id);
        return view('admin.books.edit',compact('book'));
    }

  
    public function update(Request $request, $id)
    {
        try{
            $book=Book::find($id);
            $book->title=$request->title;
            $book->auther=$request->auther;
            $book->body=$request->body;
            $book->published_year=$request->published_year;
            $book->save();
            return redirect('admin/books')->with('success_message','Book updated successfully');
        }catch(Exception $e){
            return redirect()->back()->with('erorr_message',$e->getMessage());
        }
       
    }

    public function destroy($id)
    {
        if($id){
            Book::destroy($id);
            return redirect('admin/books')->with('success_message','Book deletd successfully');
        }else{

            return redirect()->back()->with('erorr_message','Not Found');
        }

    }

    //student route
    public function books()
    {
        $books=Book::get();
        return view('student.books.index',compact('books'));
    }
    public function borrowedbooks()
    {
        $books=Book::where('status',1)->get();
        return view('admin.books.borrowed-books',compact('books'));
    }

}
