@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('global.restaurant.list') }}
                    <button id="editButton" class="btn btn-primary">Edit</button>
                </div>
                <div class="panel-body">

                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.name') }}
                                </th>
                                <td>
                                    {{ $res->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.email') }}
                                </th>
                                <td>
                                    {{ $res->email }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.phone') }}
                                </th>
                                <td>
                                    {{ $res->phone }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.code') }}
                                </th>
                                <td>
                                    {{ $res->code }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.desc') }}
                                </th>
                                <td>
                                    {{ $res->desc }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('global.restaurant.fields.url') }}
                                </th>
                                <td>
                                    @if ($res->image && $res->image->url)
                                    <img src="{{ $res->image->url ?? '' }}" alt="">
                                    @else
                                    <h6>Image Not available </h6>
                                    @endif
                                </td>
                            </tr>

                        </tbody>
                    </table>

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

                                    <form action="{{ route("admin.users.update", [$res->id]) }}" method="POST"
                                        enctype="multipart/form-data">
                                        @csrf
                                        @method('PUT')
                                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                                            <label for="name">{{ trans('global.user.fields.name') }}*</label>
                                            <input type="text" id="name" name="name" class="form-control"
                                                value="{{ old('name', isset($res) ? $res->name : '') }}">
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
                                                value="{{ old('code', isset($res) ? $res->code : '') }}">
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
                                                value="{{ old('email', isset($res) ? $res->email : '') }}">
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
                                                value="{{ old('phone', isset($res) ? $res->phone : '') }}">
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
                                                value="{{ old('desc', isset($res) ? $res->desc : '') }}">
                                            @if($errors->has('desc'))
                                            <p class="help-block">
                                                {{ $errors->first('desc') }}
                                            </p>
                                            @endif
                                            <p class="helper-block">
                                                {{ trans('global.restaurant.fields.desc_helper') }}
                                            </p>
                                        </div>
                                        <td>
                                            <label for="Preview">Preview</label>

                                            @if ($res->image && $res->image->url)
                                            <img class="" style="border: 1px solid black;"
                                                src="{{ $res->image->url ?? '' }}" alt="" height="200" width="200">
                                            @else
                                            <h6>Image Not available </h6>
                                            @endif
                                        </td>
                                        <div class="form-group {{ $errors->has('image') ? 'has-error' : '' }}">
                                            <label for="image">{{ trans('global.restaurant.fields.url') }}*</label>
                                            <input type="file" id="image" name="image" class="form-control"
                                                value="{{ old('desc', isset($res) ? $res->desc : '') }}">
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

</script>
@endsection