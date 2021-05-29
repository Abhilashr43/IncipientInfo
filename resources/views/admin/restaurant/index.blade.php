@extends('layouts.admin')
@section('content')
<div class="content">
    @can('user_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route("admin.manage.restaurant.create") }}">
                {{ trans('global.add') }} {{ trans('global.restaurant.title_singular') }}
            </a>
        </div>
    </div>
    @endcan
    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.restaurant.title_singular') }} {{ trans('global.list') }}
                </div>
                <div class="panel-body">

                    <div class="table-responsive">
                        <table class=" table table-bordered table-striped table-hover datatable">
                            <thead>
                                <tr>
                                    <th width="10">

                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.name') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.email') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.phone') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.code') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.desc') }}
                                    </th>
                                    <th>
                                        {{ trans('global.restaurant.fields.url') }}
                                    </th>
                                    <th>
                                        &nbsp;
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($restaurant as $key => $user)
                                <tr data-entry-id="{{ $user->id }}">
                                    <td>

                                    </td>
                                    <td>
                                        {{ $user->name ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->email ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->code ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->phone ?? '' }}
                                    </td>
                                    <td>
                                        {{ $user->desc ?? '' }}
                                    </td>
                                    <td>
                                        @if ($user->image && $user->image->url)
                                        <img src="{{ $user->image->url ?? '' }}" alt="" height="100" width="100">
                                        @else
                                        <h6>Image Not available </h6>
                                        @endif
                                    </td>
                                    <td>
                                        @can('user_show')
                                        <a class="btn btn-xs btn-primary"
                                            href="{{ route('admin.manage.restaurant.show', $user->id) }}">
                                            {{ trans('global.view') }}
                                        </a>
                                        @endcan
                                        @can('user_edit')
                                        <button id="editButton" class="btn btn-xs btn-info" onclick="">
                                            {{ trans('global.edit') }}
                                        </button>
                                        {{-- <a class="btn btn-xs btn-info"
                                            href="{{ route('admin.manage.restaurant.show', $user->id) }}">
                                        {{ trans('global.edit') }}
                                        </a> --}}
                                        @endcan
                                        @can('user_delete')
                                        <form action="{{ route('admin.manage.restaurant.destroy', $user->id) }}"
                                            method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                            style="display: inline-block;">
                                            <input type="hidden" name="_method" value="DELETE">
                                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                            <input type="submit" class="btn btn-xs btn-danger"
                                                value="{{ trans('global.delete') }}">
                                        </form>
                                        @endcan
                                    </td>

                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.users.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('user_delete')
  dtButtons.push(deleteButton)
@endcan

  $('.datatable:not(.ajaxTable)').DataTable({ buttons: dtButtons ,})
})

</script>
@endsection