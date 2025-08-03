<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ExaminationsDataTable;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreExaminationRequest;
use App\Models\Examination;
use App\Models\Inventory;
use App\Models\User;
use App\Services\ExaminationService;
use Illuminate\Http\Request;

class ExaminationController extends Controller
{

    public function __construct(private ExaminationService $service) {}
    /**
     * Display a listing of the resource.
     */
    public function index(ExaminationsDataTable $dataTable)
    {
        return $dataTable->render('dashboard.admin.examinations.index');
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

        $this->service->storeExamination($request->validated());

        return redirect()
            ->route('admin.users.examinations.index', $request->user_id)
            ->with('success', 'Examination added successfully.');
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


    //indexByUser
    public function indexByUser($userId, ExaminationsDataTable $dataTable)
    {
        // Assuming you have a User model and it has a relationship with Examination
        $user =  User::findOrFail($userId);
        return $dataTable->with('user', $user)->render('dashboard.admin.examinations.index_by_user', compact('user'));
    }
    //createForUser
    //
    public function createForUser($userId)
    {
        $user = User::findOrFail($userId);
        $inventories = Inventory::where('quantity' , '>', 0)->get();
        return view('dashboard.admin.examinations.create', compact('user', 'inventories'));
    }

    //storeForUser
    public function storeForUser(StoreExaminationRequest $request, $userId)
    {
        $data = $request->validated();
        $data['user_id'] = $userId;

        $this->service->storeExamination($data);

        return redirect()
            ->route('admin.users.examinations', $userId)
            ->with('success', 'created successfully.');
    }
    //editForUser
    public function editForUser($userId, $examinationId)
    {
        $user = User::findOrFail($userId);

        $examination = $user->examinations()->findOrFail($examinationId);
        $inventories = Inventory::where('quantity' , '>', 0)->get();
        return view('dashboard.admin.examinations.edit', compact('user', 'examination', 'inventories'));
    }
    //updateForUser
    public function updateForUser(StoreExaminationRequest $request, $userId, $examinationId)
    {
        $data = $request->validated();
        $data['user_id'] = $userId;

        // استدعاء الفحص
        $examination = Examination::findOrFail($examinationId);
        $examination->update($data);

        // إذا كان نوع الفحص يحتوي على نظارة، نقوم بتحديثها أو إنشائها إن لم تكن موجودة
        if ($data['exam_type'] === 'consultation_with_glasses') {
            $glassesData = collect($data)->only([
                'sph_od', 'cyl_od', 'axis_od', 'add_od', 'prism_od', 'sci_od',
                'sph_os', 'cyl_os', 'axis_os', 'add_os', 'prism_os', 'sci_os',
                'ipd', 'notes',
                'lens_type', 'lens_purchase_price', 'lens_selling_price',
                'inventory_id', 'frame_price', 'other_costs', 'consultation_cost', 'total_cost',
            ])->toArray();

            $glassesData['examination_id'] = $examination->id;

            $examination->glassesPrescription()
                ->updateOrCreate(['examination_id' => $examination->id], $glassesData);
        } else {
            // في حال تغير النوع إلى كشف فقط، احذف النظارة إن وُجدت
            $examination->glassesPrescription()?->delete();
        }

        return redirect()
            ->route('admin.users.examinations', $userId)
            ->with('success', 'Updated successfully.');
    }

    public function showPrescription($userId, $examinationId)
    {
        $examination = Examination::where('user_id', $userId)
            ->where('id', $examinationId)
            ->with('glassesPrescription')
            ->firstOrFail();

        $prescription = $examination->glassesPrescription;

        if (!$prescription) {
            return redirect()->back()->with('error', 'No prescription found for this examination.');
        }

        return view('dashboard.admin.examinations.show-prescription', compact('prescription','examination'));
    }


    public function destroy(Examination $examination)
    {
        $examination->delete();

        return response()->json(['status' => true]);
    }


}
