<?php

namespace App\Repositories;

use App\Book;
use App\Loan;
use App\User;
use App\Repositories\Interfaces\LoanRepositoryInterface;
use Illuminate\Support\Facades\Auth;

class LoanRepository implements LoanRepositoryInterface
{

    public function browse()
    {
        try {

            $id = Auth::id();
            $user = User::where('id', $id)->first();

            if ($user->role_id == 1) {

                $loans = Loan::with('user', 'book')->get();

                return response()->json($loans);

            } else {
                
                $loans = Loan::where('user_id', $user->id)->with('user', 'book')->get();

                return response()->json($loans);
            }

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function read($id)
    {

    }

    public function add($request)
    {
        try {


            if ($request['auth_role'] == 1)
            {
                $loans = Loan::where('user_id', $request['student_id'])->get();

                if ($loans) {
                    foreach ($loans as $value) {
                        if ($value->book_id == $request['book_id'] && $value->return_date == '') {
                            return response()->json(['message' => 'Student is already borrowed a copy!'], 401);
                        }
                    }
                }
            } else {
                $loans = Loan::where('user_id', $request['auth_user_id'])->get();

                if ($loans) {
                    foreach ($loans as $value) {

                        if ($value->book_id == $request['book_id'] && $value->status == 2) {
                            return response()->json(['message' => 'Your request loan is still on queue!'], 401);
                        } else {
                            if ($value->book_id == $request['book_id'] && $value->return_date == '') {
                                return response()->json(['message' => 'You already borrowed a copy!'], 401);
                            }
                        }
                    }
                }                
            }


            Loan::create([
                'book_id' => $request['book_id'],
                'user_id' => ($request['auth_role'] == 1) ? $request['student_id'] : $request['auth_user_id'],
                'issue_date' => $request['start_date'],
                'due_date' => $request['return_date'],
                'return_date' => '',
                'status' => ($request['auth_role'] == 1) ? 1 : 2,
            ]);

            $book = Book::where('id', $request['book_id'])->first();
            $book->in_stocks = ($request['auth_role'] == 1) ? $book->in_stocks - 1 : $book->in_stocks;
            $book->save();
            
            return response()->json(['message' => 'Loan Successfully Made!'], 200);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id, $request)
    {
        try {

            if ($request['update_type'] == "1") {

                $loan = Loan::where('id', $id)->first();

                if ($loan) {

                    $loan->return_date = $request['date'];
                    $loan->status = 4;
                    $loan->save();

                    $book = Book::where('id', $request['book_id'])->first();
                    $book->in_stocks = $book->in_stocks + 1;
                    $book->save();

                    return response()->json(['message' => 'Loan Successfully Updated!'], 200);
                }

                return response()->json(['message' => 'Loan Not Found!'], 404);

            } else {

                $loan = Loan::where('id', $id)->first();

                if ($loan) {

                    if ($request['status'] == 1) {

                        $book = Book::where('id', $request['book_id'])->first();
                        $book->in_stocks = $book->in_stocks - 1;
                        $book->save();

                        $loan->status = $request['status'];
                        $loan->save();

                    } else {

                        $loan->status = $request['status'];
                        $loan->save();                     
                    }

                    return response()->json(['message' => 'Loan Successfully Updated!'], 200);
                }

                return response()->json(['message' => 'Loan Not Found!'], 404);

            }


        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        // try {

        //     $book = Book::where('id', $id)->first();
        
        //     if ($book) {

        //         $book->delete();

        //         return response()->json(['message' => 'Book Successfully Deleted!'], 200);
        //     }

        //     return response()->json(['message' => 'Book Not Found!'], 404);

        // } catch (\Exception $e) {
        //     return $e->getMessage();
        // }
    }
}