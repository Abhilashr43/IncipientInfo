@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.create') }} {{ trans('global.restaurant.title_singular') }}
                </div>
                <div class="panel-body">

                    <form action="{{ route("admin.manage.restaurant.store") }}" method="POST"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="form-group {{ $errors->has('name') ? 'has-error' : '' }}">
                            <label for="name">{{ trans('global.restaurant.fields.name') }}*</label>
                            <input type="text" id="name" name="name" class="form-control"
                                value="{{ old('name', isset($role) ? $role->name : '') }}">
                            @if($errors->has('name'))
                            <p class="help-block">
                                {{ $errors->first('name') }}
                            </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.restaurant.fields.name_helper') }}
                            </p>
                        </div>
                        <div class="form-group {{ $errors->has('code') ? 'has-error' : '' }}">
                            <label for="code">{{ trans('global.restaurant.fields.code') }}*</label>
                            <input type="text" id="code" name="code" class="form-control"
                                value="{{ old('code', isset($role) ? $role->code : '') }}">
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
                                value="{{ old('email', isset($role) ? $role->email : '') }}">
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
                                value="{{ old('phone', isset($role) ? $role->phone : '') }}">
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
                                value="{{ old('desc', isset($role) ? $role->desc : '') }}">
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
                                value="{{ old('desc', isset($role) ? $role->desc : '') }}">
                            @if($errors->has('image'))
                            <p class="help-block">
                                {{ $errors->first('image') }}
                            </p>
                            @endif
                            <p class="helper-block">
                                {{ trans('global.restaurant.fields.url_helper') }}
                            </p>
                        </div>
                        <div>
                            <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
                        </div>
                    </form>

                </div>
            </div>

        </div>
    </div>
</div>
@endsection