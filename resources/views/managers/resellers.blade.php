@php
$heads = [
    ['label' =>__('resellers.id'), 'width' => 10],
    __('resellers.name'),
    __('resellers.phone'),
    __('resellers.line_id'),
    __('resellers.email'),
    __('resellers.created_at'),
    __('resellers.status'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp
<x-adminlte-datatable id="reseller-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($manager->resellers() as $reseller)
    <tr>
      <td>{{ $reseller->id }}</td>
      <td>{{ $reseller->user->name }}</td>
      <td>{{ $reseller->user->phone }}</td>
      <td>{{ $reseller->user->line_id }}</td>
      <td>{{ $reseller->user->email }}</td>
      <td>{{ $reseller->created_at->toDateString() }}</td>
      <td>{{ ($reseller->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
      <td><nobr>
          <form name="reseller-delete-form" action="{{ route('resellers.destroy', $reseller->id); }}" method="POST">
            @csrf
            @method('DELETE')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('resellers.edit', $reseller->id); }}'" >
              </x-adminlte-button>
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" >
              </x-adminlte-button>
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('resellers.show', $reseller->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

