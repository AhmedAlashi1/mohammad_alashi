
<x-datatable :dataTable="$dataTable" :title="__('inventories')">
    <x-slot:header>
        <a href="{{ route('admin.inventories.create') }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>
