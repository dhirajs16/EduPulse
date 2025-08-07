<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreBookRequest;
use App\Http\Requests\UpdateBookRequest;
use App\Services\BookService;
use App\Services\NotificationService;

class BookController extends Controller
{
    public function __construct(protected BookService $bookService)
    {}

    public function index()
    {
        $books = $this->bookService->list();
        return view('admin.books.index', compact('books'));
    }

    public function create()
    {
        return view('admin.books.create');
    }

    public function store(StoreBookRequest $request)
    {
        $data = $request->validated();
        $this->bookService->store($data);
        NotificationService::CREATED('Book created successfully.');
        return redirect()->route('admin.books.index');
    }

    public function edit(int $id)
    {
        $book = $this->bookService->find($id);
        return view('admin.books.edit', compact('book'));
    }

    public function update(UpdateBookRequest $request, int $id)
    {
        $data = $request->validated();
        $this->bookService->update($id, $data);
        NotificationService::UPDATED('Book updated successfully.');
        return redirect()->route('admin.books.index');
    }

    public function destroy(int $id)
    {
        $this->bookService->delete($id);
        NotificationService::DELETED('Book deleted successfully.');
        return redirect()->route('admin.books.index');
    }
}
