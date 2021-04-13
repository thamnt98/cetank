@extends('layouts.dashboard')

@section('style')
<link href="{{ asset('admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
<link rel="stylesheet" href="{{asset('admin/css/bootstrap-tagsinput.css')}}">
<link href="{{ asset('admin/css/bootstrap-toggle.min.css')}}" rel="stylesheet">
<link href="{{ asset('admin/css/bootstrap.min.css')}}" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.css" rel="stylesheet">
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
                    <form action="{{route('post.store')}}" method="post" class="form-horizontal" enctype="multipart/form-data">
                        <input type="hidden" value="{{isset($post) ? $post->id : 0}}" name="post_id">
                        {{csrf_field()}}
                        <div class="form-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <input type="hidden" name="userId" value="{{Auth::user()->id}}">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">title </strong></label>
                                        <div class="col-md-12">
                                            <input name="title" class="form-control input-lg" placeholder=" Title" value="{{ old('title', isset($post) ? $post->title : '') }}" required />
                                            {{-- @if($errors->has('title'))--}}
                                            {{-- <span class="text-danger text-md-left">{{ $errors->first('title') }}</span>--}}
                                            {{-- @endif--}}
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;"> Category</strong></label>
                                        <div class="col-md-12">
                                            <select name="category" id="category" class="form-control">
                                                <option value="">Select Category</option>
                                                @foreach($category as $cat)
                                                <option value="{{$cat->id}}" @if(old('category')==$cat->id) selected @endif>{{$cat->name}}</option>
                                                @endforeach
                                            </select>
                                            {{-- @if($errors->has('category'))--}}
                                            {{-- <span class="text-danger text-md-left">{{ $errors->first('category') }}</span>--}}
                                            {{-- @endif--}}
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
                                                    {{-- @if($errors->has('image'))--}}
                                                    {{-- <span class="text-danger text-md-left">{{ $errors->first('image') }}</span>--}}
                                                    {{-- @endif--}}
                                                    <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Description</strong></label>
                                        <div class="col-md-12">
                                            <textarea id="description" name="description" style="width:100%; height:100%;" class="form-control" placeholder="Description">
                                                {!! old('description', isset($post) ? $post->comment : '') !!}
                                                <p></p>
                                                <p class="MsoNormal" style="text-align: right; margin: 0cm; font-size: 12pt; font-family: Calibri, sans-serif;"><i><span style="font-size: 16px; font-family: system-ui; background-image: initial; background-position: initial; background-size: initial; background-repeat: initial; background-attachment: initial; background-origin: initial; background-clip: initial; color: rgb(33, 16, 74);">Cetank.net - Miễn trừ trách nhiệm với các thông tin đưa ra.</span></i><span style="font-family: " times="" new="" roman",="" serif;"=""><o:p></o:p></span></p>
                                                <p></p>
                                                </textarea>
                                            {{-- <div id="description" cols="50" rows="10" style="width:100%; height:100%;" class="form-control"  placeholder="Description"></div>--}}
                                            {{-- @if($errors->has('description'))--}}
                                            {{-- <span class="text-danger text-md-left">{{ $errors->first('description') }}</span>--}}
                                            {{-- @endif--}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;"> tags</strong></label>
                                        <div class="col-md-12">
                                            <input name="tags" data-role="tagsinput" class="form-control input-lg" value="{{ old('tags') }}" />
                                            {{-- @if($errors->has('tags'))--}}
                                            {{-- <span class="text-danger text-md-left">{{ $errors->first('tags') }}</span>--}}
                                            {{-- @endif--}}
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;"> Featured Status</strong> </label>
                                        <div class="col-md-12">
                                            <input data-toggle="toggle" data-onstyle="success" data-size="large" data-offstyle="danger" data-on="On" data-off="Off" data-width="100%" type="checkbox" name="fetured">
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-12">
                                            <button type="submit" onclick="nicEditors.findEditor('area1').saveContent();" class="btn btn-primary btn-block bold btn-lg uppercase"><i class="fa fa-send"></i> Create Post</button>
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
<script src="{{asset('admin/js/bootstrap-tagsinput.min.js')}}"></script>
<script src="{{ asset('admin/js/bootstrap-toggle.min.js') }}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.12/summernote-bs4.js"></script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#description').summernote({
            fontSizes: ['8', '9', '10', '11', '12', '13', '14', '15', '16', '18', '20', '22', '24', '28', '32', '36', '40', '48'],
            placeholder: 'Description',
            tabsize: 2,
            height: 120,
            toolbar: [
                ['style', ['style']],
                ['text', ['bold', 'italic', 'underline', 'color', 'clear']],
                ['para', ['ul', 'ol', 'paragraph']],
                ['height', ['height']],
                ['size', ['fontsize']],
                ['font', ['fontname']],
                ['table', ['table']],
                ['insert', ['link', 'picture', 'video']],
                ['view', ['fullscreen', 'codeview', 'help']]
            ],
            onblur: function() {
                var text = $('#editor').code();
                text = text.replace("<br>", " ");
                $('#description').val(text);
            },
        })
    })
</script>
@endsection
