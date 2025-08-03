
<x-datatable :dataTable="$dataTable" :title="__('payments')">
    <x-slot:header>
        <a href="{{ route('admin.examinations.payments.create',$examination->id) }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
        <a href="{{ route('admin.examinations.index') }}" type="button" class="btn btn-secondary waves-effect waves-light">{{__('back')}}</a>
    </x-slot:header>
</x-datatable>
