@extends('layouts.dashboard')

@section('style')
<link href="{{ asset('admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
<link href="{{ asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
<link rel="stylesheet" href="{{ asset('css/bootstrap-multiselect.css') }}" type="text/css"/>
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
                    <form method="post" action="{{ route('email.marketing.send') }}">
                        @csrf
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <a target="_blank" href="{{ url('/admin/maileclipse/templates') }}"> <i class="fa fa-angle-double-right"></i>Edit Email Template</a>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Select Email Template</label>
                                <select class="form-control" name="template_email" required>
                                    @foreach($templates as $template)
                                    <option value="{{ $template->template_slug }}"> {{ $template->template_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label>Subject</label>
                                <input class="form-control" type="text" name="title" value="{{ old('title') }}" required>
                            </div>
                            <div class="form-group col-md-6">
                                <label>Customer</label>
                                <select class="form-control" id="example-dropUp"  multiple="multiple" name="customers[]" required>>
                                    @foreach($emails as $email)
                                    <option value="{{ $email}}"> {{ $email }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-primary">Send Email</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection
@section('scripts')
<script src="{{ asset('admin/js/bootstrap-fileinput.js') }}"></script>
<script type="text/javascript" src="{{ asset('js/bootstrap-multiselect.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#example-dropUp').multiselect({
            enableFiltering: true,
            includeSelectAllOption: true,
            maxHeight: 400,
            dropUp: true
        });
    });
</script>
@endsection