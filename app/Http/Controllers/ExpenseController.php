<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Http\Requests\StoreExpenseRequest;
use App\Models\Expense;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

class ExpenseController extends Controller
{

    public function index(): View
    {
        try {
            $userId = Auth::id();
            $expenses = Expense::where('user_id', $userId)
                                ->orderBy('expense_date', 'desc')
                                ->orderBy('created_at', 'desc')
                                ->get();
        } catch (\Throwable $e) {
            Log::error("Error fetching expenses for user {$userId}: " . $e->getMessage());
            abort(500, 'Could not retrieve expenses.');
        }
        return view('expenses.index', ['expenses' => $expenses]);
    }

    public function create(): View
    {
        return view('expenses.create');
    }

    public function store(StoreExpenseRequest $request): RedirectResponse
    {
        $validatedData = $request->validated();
        try {
            $user = Auth::user();
            if (!$user) {
                throw new \Exception('User not authenticated.');
            }
            $user->expenses()->create($validatedData);
        } catch (\Throwable $e) {
            Log::error("Error saving expense for user " . Auth::id() . ": " . $e->getMessage());
            return Redirect::route('expenses.create')
                            ->withInput()
                            ->with('error', 'Could not save expense. Please try again.');
        }
        return Redirect::route('expenses.index')
                       ->with('success', 'Expense logged successfully.');
    }

    public function show(Expense $expense): RedirectResponse
    {
         if (Auth::id() !== $expense->user_id) abort(403);
         // Optionally return view('expenses.show', ['expense' => $expense]);
         return Redirect::route('expenses.index');
    }

    public function edit(Expense $expense): View | RedirectResponse
    {
        if (Auth::id() !== $expense->user_id) abort(403);
        return view('expenses.edit', ['expense' => $expense]);
    }

    public function update(StoreExpenseRequest $request, Expense $expense): RedirectResponse
    {
        if (Auth::id() !== $expense->user_id) abort(403);
        $validated = $request->validated();
        try {
             $expense->update($validated);
        } catch (\Throwable $e) {
            Log::error("Error updating expense ID {$expense->id} for user " . Auth::id() . ": " . $e->getMessage());
            return Redirect::route('expenses.edit', $expense)
                           ->withInput()
                           ->with('error', 'Could not update expense. Please try again.');
        }
       return Redirect::route('expenses.index')->with('success', 'Expense updated successfully.');
    }

    public function destroy(Expense $expense): RedirectResponse
    {
        if (Auth::id() !== $expense->user_id) {
            Log::warning("User " . Auth::id() . " attempted delete on expense {$expense->id} owned by user {$expense->user_id}.");
            abort(403, 'Unauthorized action.');
        }
        try {
            $expense->delete();
        } catch (\Throwable $e) {
            Log::error("Error deleting expense ID {$expense->id} for user " . Auth::id() . ": " . $e->getMessage());
            return Redirect::route('expenses.index')
                           ->with('error', 'Could not delete expense. Please try again.');
        }
        return Redirect::route('expenses.index')
                       ->with('success', 'Expense deleted successfully.');
    }
}