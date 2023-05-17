@php
$heads = [
    ['label' =>__('distrobuters.id'), 'width' => 10],
    __('distrobuters.name'),
    __('distrobuters.phone'),
    __('distrobuters.line_id'),
    __('distrobuters.created_at'),
    __('distrobuters.status'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp
<x-adminlte-datatable id="distrobuter-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($reseller->distrobuters() as $distrobuter)
    <tr>
      <td>{{ $distrobuter->id }}</td>
      <td>{{ $distrobuter->user->name }}</td>
      <td>{{ $distrobuter->user->phone }}</td>
      <td>{{ $distrobuter->user->line_id }}</td>
      <td>{{ $distrobuter->created_at->toDateString() }}</td>
      <td>{{ ($distrobuter->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
      <td><nobr>
          <form name="distrobuter-delete-form" action="{{ route('distrobuters.destroy', $distrobuter->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->role <= App\Enums\UserRole::Distrobuter)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('distrobuters.edit', $distrobuter->id); }}'" >
              </x-adminlte-button>
            @endif
            @if (auth()->user()->role <= App\Enums\UserRole::Manager)
              <x-adminlte-button theme="danger" title="{{ __('tables.delete') }}" icon="fa fa-lg fa-fw fa-trash"
                type="submit" >
              </x-adminlte-button>
             @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('distrobuters.show', $distrobuter->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

