
<x-datatable :dataTable="$dataTable" :title="__('users')">
    <x-slot:header>
        <a href="{{ route('admin.users.create') }}" type="button" class="btn btn-primary waves-effect waves-light">{{__('dataTable.add')}}</a>
    </x-slot:header>
</x-datatable>
