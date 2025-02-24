<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Payment;
use Illuminate\Http\Request;
use BalajiDharma\LaravelAdminCore\Grid\UserGrid;

class PaymentController extends Controller
{
    // public function index()
    // {
    //     $payments = Payment::latest()->paginate(10);
    //     // dd($payments);
    //     return view('admin.payments.index', compact('payments'));
    // }

    public function index()
    {
        $this->authorize('viewAny', Payment::class);
        $paymentQuery = (new Payment)->newQuery()->with(['roles']);
    // $paymentQuery = Payment::query(); 

    // Ensure the correct grid class is used
    $crud = (new UserGrid)->list($paymentQuery);

    // Check if `$crud` is actually returning data
    if (empty($crud)) {
        dd('Error: $crud is empty', $crud);
    }

    return view('admin.crud.index', compact('crud'));
    }

    // public function show($id)
    // {
    //     $payment = Payment::with('user')->findOrFail($id);
    //     return view('admin.payments.show', compact('payment'));
    // }

    // public function edit(Payment $payment)
    // {
    //     return view('admin.payments.edit', compact('payment'));
    // }

    // public function update(Request $request, Payment $payment)
    // {
    //     $request->validate([
    //         'status' => 'required|in:pending,completed,failed',
    //     ]);

    //     $payment->update([
    //         'status' => $request->status,
    //     ]);

    //     return redirect()->route('admin.payments.index')->with('success', 'Payment status updated successfully.');
    // }

    // public function destroy(Payment $payment)
    // {
    //     $payment->delete();
    //     return redirect()->route('admin.payments.index')->with('success', 'Payment deleted successfully.');
    // }
}
