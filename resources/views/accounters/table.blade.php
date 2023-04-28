@php
$heads = [
    ['label' =>__('accounters.id'), 'width' => 10],
    __('accounters.name'),
    __('accounters.phone'),
    __('accounters.line_id'),
    __('accounters.created_by'),
    __('accounters.status'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Chinese.json' ],
];
@endphp
<x-adminlte-datatable id="accounter-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($accounters as $accounter)
    <tr>
      <td>{{ $accounter->id }}</td>
      <td>{{ $accounter->name }}</td>
      <td>{{ $accounter->phone }}</td>
      <td>{{ $accounter->line_id }}</td>
      <td>{{ $accounter->creator->name }}</td>
      <td>{{ ($accounter->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
      <td><nobr>
          <form name="accounter-delete-form" action="{{ route('accounters.destroy', $accounter->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->role != 'operator')
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('accounters.edit', $accounter->id); }}'" >
              </x-adminlte-button>
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" >
              </x-adminlte-button>
             @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('accounters.show', $accounter->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

