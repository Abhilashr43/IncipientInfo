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
                                        <img src="{{ $user->image->url ?? '' }}" alt="">
                                        @else
                                        <h6>Image Not available </h6>
                                        @endif
                                    </td>
                                    {{-- <td>
                                        @foreach($user->roles as $key => $item)
                                        <span class="label label-info label-many">{{ $item->title }}</span>
                                    @endforeach
                                    </td> --}}
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

<div id="modalEdit" class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="content">

                    <div class="row">
                        <div class="col-lg-12">

                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    {{ trans('global.edit') }} {{ trans('global.user.title_singular') }}
                                </div>
                                <div class="panel-body">

                                    <form action="{{ route("admin.users.update", [$user->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label for="name">{{ trans('global.user.fields.name') }}*</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                value="{{ old('name', isset($user) ? $user->name : '') }}">
                                            @if($errors->has('name'))
                                            <p class="help-block">
                                                {{ $errors->first('name') }}
                                            </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('global.user.fields.name_helper') }}
                                            </p>
                                        </div>
                                        <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                                            <label for="code">{{ trans('global.restaurant.fields.code') }}*</label>
                                            <input type="text" id="code" name="code" class="form-control"
                                                value="{{ old('code', isset($user) ? $user->code : '') }}">
                                            @if($errors->has('code'))
                                            <p class="help-block">
                                                {{ $errors->first('code') }}
                                            </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('global.restaurant.fields.name_helper') }}
                                            </p>
                                        </div>
                                        <div class="form-group {{ $errors->has('email') ? 'has-error' : '' }}">
                                            <label for="email">{{ trans('global.restaurant.fields.email') }}*</label>
                                            <input type="text" id="email" name="email" class="form-control"
                                                value="{{ old('email', isset($user) ? $user->email : '') }}">
                                            @if($errors->has('email'))
                                            <p class="help-block">
                                                {{ $errors->first('email') }}
                                            </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('global.restaurant.fields.email_helper') }}
                                            </p>
                                        </div>
                                        <div class="form-group {{ $errors->has('phone') ? 'has-error' : '' }}">
                                            <label for="phone">{{ trans('global.restaurant.fields.phone') }}*</label>
                                            <input type="text" id="phone" name="phone" class="form-control"
                                                value="{{ old('phone', isset($user) ? $user->phone : '') }}">
                                            @if($errors->has('phone'))
                                            <p class="help-block">
                                                {{ $errors->first('phone') }}
                                            </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('global.restaurant.fields.phone_helper') }}
                                            </p>
                                        </div>
                                        <div class="form-group {{ $errors->has('desc') ? 'has-error' : '' }}">
                                            <label for="desc">{{ trans('global.restaurant.fields.desc') }}*</label>
                                            <input type="text" id="desc" name="desc" class="form-control"
                                                value="{{ old('desc', isset($user) ? $user->desc : '') }}">
                                            @if($errors->has('desc'))
                                            <p class="help-block">
                                                {{ $errors->first('desc') }}
                                            </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('global.restaurant.fields.desc_helper') }}
                                            </p>
                                        </div>
                                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                            <label for="image">{{ trans('global.restaurant.fields.url') }}*</label>
                                            <input type="file" id="image" name="image" class="form-control"
                                                value="{{ old('desc', isset($user) ? $user->desc : '') }}">
                                            @if($errors->has('image'))
                                            <p class="help-block">
                                                {{ $errors->first('image') }}
                                            </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('global.restaurant.fields.url_helper') }}
                                            </p>
                                        </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">{{ trans('global.save') }}</button>
            </div>
            </form>
        </div>
    </div>
</div>
@endsection
@section('scripts')
@parent
<script>
    $(document).ready(function () {

$("#editButton").click(function(){
    alert('clicked')
    $('#modalEdit').modal('show');
});
});
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