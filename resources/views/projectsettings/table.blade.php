@php
$heads = [
    ['label' =>__('projectsettings.id'), 'width' => 10],
    __('projectsettings.project'),
    __('projectsettings.company'),
    __('projectsettings.name'),
    __('projectsettings.created_by'),
    __('projectsettings.status'),
    ['label' => __('tables.action'), 'no-export' => true, 'width' => 10],
];
$config = [
    'order' => [[0, 'desc']],
    'columns' => [null, null, null, null, null, null, ['orderable' => false]],
    'language' => [ 'url' => '//cdn.datatables.net/plug-ins/1.13.4/i18n/zh-HANT.json' ],
];
@endphp
<x-adminlte-datatable id="projectsetting-table" :heads="$heads" :config="$config" theme="info" head-theme="dark" striped hoverable bordered>
  @foreach($managers as $manager)
    <tr>
      <td>{{ 'B235'.sprintf('%02d',$manager->id) }}</td>
      <td>{{ ($manager->project()) ? $manager->project()->name : __('projectsettings.project_none') }}</td>
      <td>{{ $manager->company }}</td>
      <td>{{ $manager->user->name }}</td>
      <td>{{ $manager->creator->name  }}</td>
      <td>{{ ($manager->status==1) ? __('tables.status_on'):__('tables.status_off') }}</td>
      <td><nobr>
          <x-adminlte-button theme="primary" title="{{ __('tables.edit') }}" icon="fa fa-lg fa-fw fa-pen"
            onClick="window.location='{{ route('projectsettings.edit', $manager->id); }}'" >
          </x-adminlte-button>
      </nobr></td>
    </tr>
  @endforeach
</x-adminlte-datatable>
@section('plugins.Datatables', true)
@section('plugins.DatatablesPlugin', true)

