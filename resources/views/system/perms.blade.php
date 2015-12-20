@extends('master')
@section('title', 'Permission Management')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div>
                <button type="button" class="btn btn-success text-right pull-right" data-toggle="modal" data-target="#newPerm"><i class="fa fa-plus fa-fw"></i> New Permission Set</button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 top-padded">
            @include('partials.alerts')
            <div class="box box-default">
                <div class="box-header with-border">
                    <h3 class="box-title"><i class="fa fa-lock fa-fw"></i> Permission Sets</h3>
                </div>
                <div class="box-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th class="text-center">Accounting Modules</th>
                                <th class="text-center">Reports Modules</th>
                                <th class="text-center">System Modules</th>
                                <th class="text-center">Creation Date</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach ($permissions as $permission)
                                <tr>
                                    <td>{{ $permission->name }}</td>
                                    <td class="text-center"><input type="checkbox" name="accounting" disabled @if ($permission->accounting) checked @endif /></td>
                                    <td class="text-center"><input type="checkbox" name="reports" disabled @if ($permission->reports) checked @endif /></td>
                                    <td class="text-center"><input type="checkbox" name="system" disabled @if ($permission->system) checked @endif /></td>
                                    <td class="text-center">{{ $permission->created_at }}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="box-footer">
                    <span class="text-right pull-right">{!! $permissions->render() !!}</span>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <div id="newPerm" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <form action="{{ URL('/perms/save') }}" method="post">
                {!! csrf_field() !!}
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">New Permission Set</h4>
                    </div>
                    <div class="modal-body">
                            <div class="form-group">
                                <label for="name">Permission Set Name</label>
                                <input id="name" class="form-control" name="name" required />
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="accounting" /> Access to Accounting Modules
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="reports" /> Access to Reports Modules
                                </label>
                            </div>
                            <div class="checkbox">
                                <label>
                                    <input type="checkbox" name="system" /> Access to System Modules
                                </label>
                            </div>
                    </div>
                    <div class="modal-footer">
                        <input type="submit" class="btn btn-success" value="Save" />
                    </div>
                </div>
            </form>
        </div>
    </div>
    <script src="{{ asset("/bower_components/ckeditor/ckeditor.js") }}" type="text/javascript"></script>
    <script>
        CKEDITOR.replace('ck', {
            height: '400px',
        });
    </script>
    <script>
        $(function() {
            // Navigation
            $('li.perms').addClass('active');
        });
    </script>
@endsection