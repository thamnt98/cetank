@extends('layouts.dashboard')

@section('style')
    <link href="{{ asset('admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
    <link href="{{ asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
@endsection
@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <h5>{{ $page_title }}</h5>
                        <div class="card-header-right">
                            <ul class="list-unstyled card-option">
                                <li><i class="fa fa-chevron-left"></i></li>
                                <li><i class="fa fa-window-maximize full-card"></i></li>
                                <li><i class="fa fa-minus minimize-card"></i></li>
                                <li><i class="fa fa-times close-card"></i></li>
                            </ul>
                        </div>
                    </div>
                    <div class="card-block">
                        <form action="{{route('staff.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                            {{csrf_field()}}
                            <div class="form-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Email</strong></label>
                                            <div class="col-md-12">
                                                <input name="email" type="email" class="form-control input-lg" placeholder=" Email" value="{{ old('email') }}" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Full name</strong></label>
                                            <div class="col-md-12">
                                                <input name="name" type="text" class="form-control input-lg" placeholder="Full Name" value="{{ old('name') }}" required/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Phone number</strong></label>
                                            <div class="col-md-12">
                                                <input name="phone" type="text" class="form-control input-lg" placeholder="Phone Number" value="{{ old('phone') }}"/>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;"> Image</strong></label>
                                            <div class="col-md-12">
                                                <div class="fileinput fileinput-new" data-provides="fileinput">
                                                    <div class="fileinput-new thumbnail" style="width: 400px; height: 220px;" data-trigger="fileinput">
                                                        <img style="width: 400px" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text= Image" alt="...">
                                                    </div>
                                                    <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 220px"></div>
                                                    <div>
                                                        <span class="btn btn-info btn-file">
                                                            <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                            <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                            <input type="file" name="image" accept="image/*">
                                                        </span>
                                                        {{--                                                        @if($errors->has('image'))--}}
                                                        {{--                                                            <span class="text-danger text-md-left">{{ $errors->first('image') }}</span>--}}
                                                        {{--                                                        @endif--}}
                                                        <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="form-group">
                                            <label class="col-md-12"><strong style="text-transform: uppercase;">Role</strong></label>
                                            <select name="role_id" class="form-control">
                                                <option value="2">Author</option>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <div class="col-md-12">
                                                <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();" class="btn btn-primary btn-block bold btn-lg uppercase"><i class="fa fa-send"></i> Create Staff</button>
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- row -->
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection
@section('scripts')
    <script src="{{ asset('admin/js/bootstrap-fileinput.js') }}"></script>
@endsection
