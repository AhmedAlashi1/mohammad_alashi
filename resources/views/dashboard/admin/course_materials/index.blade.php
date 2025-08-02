
<x-datatable :dataTable="$dataTable" :title="__('general.lesson_sections')">
    <x-slot:header>
        <a href="{{ route('admin.subjects.materials.create',[$subject->id,$type]) }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
        <a href="{{ route('admin.subjects.index') }}" class="btn btn-secondary waves-effect waves-light">{{__('general.back')}}</a>
    </x-slot:header>
</x-datatable>
