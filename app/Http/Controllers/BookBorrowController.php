<?php

namespace App\Http\Controllers;

use App\Models\Book;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookBorrowController extends Controller
{
    public function borrow(Request $request, $book_id)
    {
        // الحصول على الطالب الحالي (المسجل الدخول)
        $student = auth()->user();  // نفترض أن الطالب مسجل دخول
        
        // الحصول على الكتاب المطلوب استعارته
        $book = Book::find($book_id);

        if (!$book) {
            return back()->with('error', 'الكتاب غير موجود.');
        }

        // التحقق ما إذا كان الطالب استعار الكتاب بالفعل
        if ($student->books()->where('book_id', $book->id)->exists()) {
            return back()->with('erorr_message', 'لقد قمت بالفعل باستعارة هذا الكتاب.');
        }

        $student->books()->attach($book->id, [
            'borrowed_at' => now(),
            'return_by' => now()->addDays(7) 
        ]);
        $book->status=1;
        $book->save();

        return back()->with('success_message', 'تم استعارة الكتاب بنجاح.');
    }


    public function borrowedbooks($id=null){
        $student = auth()->user(); 
        if($id!=null){
            $student->books()->detach($id);
            $book=Book::find($id);
            $book->status=0;
            $book->save();
            return back()->with('success_message','تم اعادة الكتاب بنجاح');
        }
        
        $borrowedBooks = $student->books()->withPivot('borrowed_at', 'return_by')->get();
        return view('student.books.borrowed_books', compact('borrowedBooks'));
    }
}
