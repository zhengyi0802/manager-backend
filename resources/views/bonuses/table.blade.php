@php
$heads = [
    ['label' =>__('bonuses.id'), 'width' => 10],
    __('bonuses.name'),
    __('bonuses.amount'),
    __('bonuses.date'),
    __('bonuses.status'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp
<x-adminlte-datatable id="bonus-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($bonuses as $bonus)
    <tr>
      <td>{{ $bonus->id }}</td>
      <td>{{ $bonus->member->user->name }}</td>
      <td>{{ $bonus->amount }}</td>
      <td>{{ $bonus->created_at }}</td>
      <td>{{ trans_choice('bonuses.bonus_statuses', $bonus->process_status) }}</td>
      <td><nobr>
          <a class="btn btn-success" href="{{ route('bonuses.transfered', $bonus->id) }}">{{ __('bonuses.transfered') }}</a>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

