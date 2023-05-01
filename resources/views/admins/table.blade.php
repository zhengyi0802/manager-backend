@php
$heads = [
    ['label' =>__('admins.id'), 'width' => 10],
    __('admins.name'),
    __('admins.phone'),
    __('admins.line_id'),
    __('admins.created_by'),
    __('admins.status'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="admin-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($admins as $admin)
    <tr>
      <td>{{ $admin->id }}</td>
      <td>{{ $admin->name }}</td>
      <td>{{ $admin->phone }}</td>
      <td>{{ $admin->line_id }}</td>
      <td>{{ $admin->creator->name  }}</td>
      <td>{{ ($admin->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
      <td><nobr>
          <form name="admin-delete-form" action="{{ route('admins.destroy', $admin->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->name == 'Admin' || auth()->user()->id == $admin->id)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('admins.edit', $admin->id); }}'" >
              </x-adminlte-button>
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" >
              </x-adminlte-button>
             @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('admins.show', $admin->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

