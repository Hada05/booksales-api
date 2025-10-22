<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Transaction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TransactionController extends Controller
{
    public function index()
    {
        $transaction = Transaction::with('user', 'book')->get();

        if ($transaction->isEmpty()) {
            return response()->json([
                'message' => 'No transactions found.'
            ], 404);
        }

        return response()->json([
            'message' => 'Transactions retrieved successfully.',
            'data' => $transaction
        ], 200);
    }

    public function store(Request $request)
    {
        //validator cek validator
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        //generate orderNumber -> unique | ORD-003
        $uniqueCode = 'ORD-' . strtoupper(uniqid());

        //ambil user yang sedang login dan cek login
        $user = auth('api')->user();

        if (!$user) {
            return response()->json([
                'success' => false,
                'message' => 'Unauthorized',
            ], 401);
        }

        //mencari data buku
        $book = Book::find($request->book_id);

        //cek stok buku
        if ($book->stock < $request->quantity) {
            return response()->json([
                'success' => false,
                'message' => 'Insufficient stock',
            ], 400);
        }

        //hitung total harga = price * quantity
        $totalAmount = $book->price * $request->quantity;

        //kurangi stok buku 
        $book->stock -= $request->quantity;
        $book->save();

        //simpan data transaksi
        $transaction = Transaction::create([
            'order_number' => $uniqueCode,
            'customer_id' => $user->id,
            'book_id' => $request->book_id,
            'total_amount' => $totalAmount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction created successfully',
            'data' => $transaction,
        ], 201);
    }

    public function show($id)
    {
        $transaction = Transaction::with('user', 'book')->find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        return response()->json([
            'message' => 'Transaction retrieved successfully.',
            'data' => $transaction
        ], 200);
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        // Validasi input
        $validator = Validator::make($request->all(), [
            'book_id' => 'required|exists:books,id',
            'quantity' => 'required|integer|min:1',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation Error',
                'errors' => $validator->errors(),
            ], 422);
        }

        $user = auth('api')->user();
        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        // Ambil buku lama dan balikin stok-nya
        $oldBook = Book::find($transaction->book_id);
        $oldBook->stock += $transaction->quantity;
        $oldBook->save();

        // Ambil buku baru
        $newBook = Book::find($request->book_id);

        // Cek stok buku baru
        if ($newBook->stock < $request->quantity) {
            return response()->json(['message' => 'Insufficient stock'], 400);
        }

        // Kurangi stok buku baru
        $newBook->stock -= $request->quantity;
        $newBook->save();

        // Hitung ulang total harga
        $totalAmount = $newBook->price * $request->quantity;

        // Update data transaksi
        $transaction->update([
            'book_id' => $request->book_id,
            'quantity' => $request->quantity,
            'total_amount' => $totalAmount,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Transaction updated successfully',
            'data' => $transaction->load('book', 'user'),
        ], 200);
    }

    public function destroy($id)
    {
        $transaction = Transaction::find($id);

        if (!$transaction) {
            return response()->json(['message' => 'Transaction not found'], 404);
        }

        $transaction->delete();

        return response()->json(['message' => 'Transaction deleted successfully'], 200);
    }
}
