@extends('master')
@section('title', 'Edit User')

@section('content')
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['url' => '/users/edit/save', 'method' => 'post', 'files' => true]) !!}
            {!! csrf_field() !!}
            <input type="hidden" name="id" value="{{ $id }}" />
            <div class="box box-default">
                <div class="box-body">
                    @include('partials.alerts')
                    <div class="form-group">
                        <label for="email">E-mail address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="E-mail Address" value="@if (empty(old('email'))) {{ $editUser->email }} @else {{ old('email') }} @endif" required />
                    </div>
                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" class="form-control" name="password" id="password" placeholder="Leave blank to remain unchanged" />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="password">Confirm Password</label>
                                <input type="password" class="form-control" name="password_confirmation" id="password" placeholder="Leave blank to remain unchanged" />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="permission">Permission Set</label>
                                <select id="permission" class="form-control" name="permission">
                                    @foreach ($permissions as $permission)
                                        <option value="{{ $permission->id }}" @if ($editUser->permission == $permission->id) selected @endif>{{ $permission->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="branch_specific">Branch-Specific?</label>
                                <select id="branch_specific" class="form-control" name="branch_specific">
                                    <option value="0" @if (!$editUser->branch_specific) selected @endif>User can access records from all branches</option>
                                    <option value="1" @if ($editUser->branch_specific) selected @endif>User can only access records from own branch</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="branch">Branch</label>
                                <select id="branch" class="form-control" name="branch">
                                    @foreach ($branches as $branch)
                                        <option value="{{ $branch->id }}" @if ($editUser->branch == $branch->id) selected @endif>{{ $branch->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="job">Job</label>
                                <input type="text" class="form-control" name="job" id="job" value="@if (empty(old('job'))) {{ $editUser->job }} @else {{ old('job') }} @endif" required />
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="first_name">First Name</label>
                                <input type="text" class="form-control" name="first_name" id="first_name" value="@if (empty(old('first_name'))){{ $editUser->first_name }}@else{{ old('first_name') }}@endif" required />
                            </div>
                        </div>
                        <div class="col-xs-12 col-md-6">
                            <div class="form-group">
                                <label for="last_name">Last Name</label>
                                <input type="text" class="form-control" name="last_name" id="last_name" value="@if (empty(old('last_name'))){{ $editUser->last_name }}@else{{ old('last_name') }}@endif" required />
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="address" >Address</label>
                        <textarea id="address" name="address" class="form-control" rows="7" required>@if (empty(old('address'))){{ $editUser->address }}@else{{ old('address') }}@endif</textarea>
                    </div>

                    <div class="form-group">
                        <label for="contact">Contact Number <span class="text-muted">optional</span></label>
                        <input type="text" class="form-control" name="contact" id="contact" value="@if(empty(old('contact_no'))){{ $editUser->contact }}@else{{ old('contact_no') }}@endif" />
                    </div>

                    <div class="form-group">
                        <label for="photo">Photo</label>
                        {!! Form::file('image') !!}
                        <p class="help-block"><strong>Optional.</strong><br />Avatars uploaded here take priority over Gravatar.<br />Must not exceed {{ ini_get('upload_max_filesize') }}B. Images only (JPG, PNG, GIF).</p>
                    </div>
                </div>
                <div class="box-footer text-center">
                    <input type="submit" class="btn btn-success" value="Edit User" />
                </div>
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection

@section('scripts')
    <div id="branchSpecific" class="modal fade" role="dialog">
        <div class="modal-dialog">

            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"><i class="fa fa-info-circle"></i> Branch-Specific Users</h4>
                </div>
                <div class="modal-body">
                    <p>Users that are <strong>branch-specific</strong> can only add, update or view records from their own branch. This is recommended for users whose branches are not the main office, or for users that have no authority to view records of branches other than their own.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success" data-dismiss="modal">Close</button>
                </div>
            </div>

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
            $('li.users').addClass('active');
        });
    </script>
@endsection