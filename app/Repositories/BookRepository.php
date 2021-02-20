<?php

namespace App\Repositories;

class BookRepository
{

    public function __construct($book)
    {
        $this->book = $book;
    }

    public function browse()
    {
        try {

            $books = $this->book->all();

            return response()->json($books);

        } catch (\Exception $e) {
            return $e->getMessage();
        }

    }

    public function read($id)
    {
        try {
            return $this->book->find($id);
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function add($request)
    {
        try {

            $this->book->create([
                'name' => $request['book_name'],
                'category' => $request['category'],
                'author' => $request['author'],
                'published_date' => $request['published_date'],
                'no_of_copies' => $request['qty'],
                'in_stocks' => $request['qty'],
            ]);

            return response()->json(['message' => 'Book Successfully Created!'], 200);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function edit($id, $request)
    {
        try {

            $book = $this->book->where('id', $id)->first();

            if ($book) {

                $book->name = $request['name'];
                $book->category = $request['category'];
                $book->author = $request['author'];
                $book->published_date = $request['published_date'];
                $book->no_of_copies = $book->no_of_copies + $request['created_at'];
                $book->in_stocks = $book->in_stocks + $request['created_at'];
                $book->save();

                return response()->json(['message' => 'Book Successfully Updated!'], 200);
            }

            return response()->json(['message' => 'Book Not Found!'], 404);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function delete($id)
    {
        try {

            $book = $this->book->where('id', $id)->first();
        
            if ($book) {

                $book->delete();

                return response()->json(['message' => 'Book Successfully Deleted!'], 200);
            }

            return response()->json(['message' => 'Book Not Found!'], 404);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

    public function checkBook($id)
    {
        try {
            
            $book = $this->book->where('id', $id)->first();

            if ($book) 
            {
                if ($book->in_stocks > 0) {
                    return response()->json(['message' => 'Book available!'], 200);
                } else {
                    return response()->json(['message' => 'This book is not available'], 404);
                }
            }

            return response()->json(['message' => 'Book is not Found!'], 404);

        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}