@php
$heads = [
    ['label' =>__('bonuslists.id'), 'width' => 10],
    __('bonuslists.name'),
    __('bonuslists.order'),
    __('bonuslists.customer'),
    __('bonuslists.amount'),
    __('bonuslists.date'),
    __('bonuslists.status'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp
<x-adminlte-datatable id="bonuslist-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($bonuslists as $bonuslist)
    <tr>
      <td>{{ $bonuslist->id }}</td>
      <td>{{ ($bonuslist->manager_used) ? $bonuslist->manager->user->name : $bonuslist->member->user->name }}</td>
      <td>{{ $bonuslist->order->id }}</td>
      <td>{{ ($bonuslist->order->is_manager) ? $bonuslist->order->manager->user->name :  $bonuslist->order->member->user->name }}</td>
      <td>{{ $bonuslist->amount }}</td>
      <td>{{ $bonuslist->created_at }}</td>
      <td>{{ trans_choice('bonuslists.bonus_statuses', $bonuslist->process_status) }}</td>
      <td><nobr>
             @if (auth()->user()->role == App\Enums\UserRole::Accounter
                 || auth()->user()->role == App\Enums\UserRole::Administrator)
              <x-adminlte-button theme="primary" title="{{ __('tables.funded') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('bonuslists.funded', $bonuslist->id); }}'" >
              </x-adminlte-button>
             @endif
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

