
<x-datatable :dataTable="$dataTable" :title="__('examinations')">
    <x-slot:header>
        <a href="{{ route('admin.users.examinations.create',$user->id) }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
        <a href="{{ route('admin.users.index') }}" type="button" class="btn btn-secondary waves-effect waves-light">{{__('back')}}</a>
    </x-slot:header>
</x-datatable>
