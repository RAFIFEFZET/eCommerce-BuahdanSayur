@extends('layouts.app')

@section('content')
<link href="{{ asset('css/profile.css') }}" rel="stylesheet">
<div class="container bootstrap snippets bootdeys">
    <div class="row">
        <div class="col-xs-12 col-sm-9">
            <form class="form-horizontal" method="POST" action="{{ route('profile.update') }}">
                @csrf
                @method('PUT')
                <div class="panel panel-default">
                    <div class="panel-body text-center">
                        <img src="https://bootdey.com/img/Content/avatar/avatar6.png" class="img-circle profile-avatar" alt="User avatar">
                    </div>
                </div>
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">User info</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Location</label>
                            <div class="col-sm-10">
                                <select class="form-control" name="location">
                                    <option selected="">Select country</option>
                                    <option>Belgium</option>
                                    <option>Canada</option>
                                    <option>Denmark</option>
                                    <option>Estonia</option>
                                    <option>France</option>
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Company name</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="company_name">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Position</label>
                            <div class="col-sm-10">
                                <input type="text" class="form-control" name="position">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Contact info</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Work number</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" name="work_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Mobile number</label>
                            <div class="col-sm-10">
                                <input type="tel" class="form-control" name="mobile_number">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">E-mail address</label>
                            <div class="col-sm-10">
                                <input type="email" class="form-control" name="email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Work address</label>
                            <div class="col-sm-10">
                                <textarea rows="3" class="form-control" name="work_address"></textarea>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h4 class="panel-title">Security</h4>
                    </div>
                    <div class="panel-body">
                        <div class="form-group">
                            <label class="col-sm-2 control-label">Current password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="current_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="col-sm-2 control-label">New password</label>
                            <div class="col-sm-10">
                                <input type="password" class="form-control" name="new_password">
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <div class="checkbox">
                                    <input type="checkbox" id="checkbox_1" name="make_public">
                                    <label for="checkbox_1">Make this account public</label>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="col-sm-10 col-sm-offset-2">
                                <button type="submit" class="btn btn-primary">Submit</button>
                                <button type="reset" class="btn btn-default">Cancel</button>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
