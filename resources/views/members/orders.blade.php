@php
$heads = [
    ['label' =>__('orders.id'), 'width' => 10],
    __('orders.name'),
    __('orders.phone'),
    __('orders.model'),
    __('orders.created_at'),
    __('orders.flow_status'),
    __('orders.paid_date_1'),
    __('orders.completed'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp
<x-adminlte-datatable id="order-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($member->orders as $order)
    <tr>
      <td>{{ $order->id }}</td>
      <td>{{ ($order->member) ? $order->member->user->name : "" }}</td>
      <td>{{ $order->phone }}</td>
      <td>{{ ($order->model == 1) ? __('orders.model_75') : __('orders.model_65') }}</td>
      <td>{{ $order->created_at->toDateString() }}</td>
      <td>{{ trans_choice('orders.flow_statuses', $order->flow_status) }}</td>
      <td>{{ $order->paid_date_1 }}</td>
      <td>{{ ($order->completed==1) ? __('tables.yes'):__('tables.no') }}</td>
      <td><nobr>
          <form name="order-delete-form" action="{{ route('orders.destroy', $order->id); }}" method="POST">
            @csrf
            @method('DELETE')
            @if (auth()->user()->id == $order->member->user->id
                 || auth()->user()->role == App\Enums\UserRole::Accounter
                 || auth()->user()->role == App\Enums\UserRole::Administrator)
              <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
                onClick="window.location='{{ route('orders.edit', $order->id); }}'" >
              </x-adminlte-button>
             @endif
              <x-adminlte-button theme="info" title="{{ __('tables.detail') }}" icon="fa fa-lg fa-fw fa-eye"
                onClick="window.location='{{ route('orders.show', $order->id); }}'" >
              </x-adminlte-button>
            </form>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

