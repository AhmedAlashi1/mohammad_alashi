<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PaymentsDataTable;
use App\Http\Controllers\Controller;
use App\Models\Examination;
use App\Models\Payment;
use Illuminate\Http\Request;

class PaymentsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(PaymentsDataTable $dataTable){
        return $dataTable->render('dashboard.admin.payments.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */


    public function indexByExamination(PaymentsDataTable $dataTable, Examination $examination)
    {
        return $dataTable->with('examinationId', $examination->id)
            ->render('dashboard.admin.payments.index_by_examination', ['examination' => $examination]);
    }

    public function createPayment(Examination $examination)
    {
        return view('dashboard.admin.payments.create', ['examination' => $examination]);
    }
    //storePayment
    public function storePayment(Request $request, Examination $examination)
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'notes' => 'nullable|string',
            'payment_type' => 'required|in:consultation,glasses',
            'method' => 'required|in:cash,online',
        ]);

        $data['user_id'] = $examination->user_id;
        $data['examination_id'] = $examination->id;

        $payment = $examination->payments()->create($data);

        return redirect()->route('admin.examinations.payments', ['examination' => $examination])
            ->with('success', __('Payment created successfully.'));
    }
    //editPayment
    public function editPayment(Examination $examination, $paymentId)
    {
        $payment = $examination->payments()->findOrFail($paymentId);
        return view('dashboard.admin.payments.edit', [
            'examination' => $examination,
            'payment' => $payment,
        ]);
    }
    //updatePayment
    public function updatePayment(Request $request, Examination $examination, $paymentId)
    {
        $data = $request->validate([
            'amount' => 'required|numeric',
            'notes' => 'nullable|string',
            'payment_type' => 'required|in:consultation,glasses',
            'method' => 'required|in:cash,online',
        ]);

        $payment = $examination->payments()->findOrFail($paymentId);
        $payment->update($data);

        return redirect()->route('admin.examinations.payments', ['examination' => $examination])
            ->with('success', __('Payment updated successfully.'));
    }


        public function destroy(Payment $payment)
        {
            $payment->delete();

            return response()->json(['status' => true]);
        }



}
