@extends('layouts.admin')
@section('content')
<div class="content">

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-heading">
                    {{ trans('global.show') }} {{ trans('global.restaurant.list') }}
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
@endsection