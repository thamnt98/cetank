@extends('layouts.dashboard')
@section('style')
    <link href="{{ asset('admin/css/bootstrap-fileinput.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-body">
        <div class="row">
            <div class="col-sm-12">
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('menu.control') }}" class="btn btn-primary"><i class="fa fa-eye"></i> All Menu</a>
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
                            <form class="form-horizontal" action="{{ route('menu.update',$menu->id) }}" method="post" role="form" enctype="multipart/form-data">
                                {!! csrf_field() !!}
                                <div class="form-body">
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Menu Name</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control input-lg" name="name" placeholder="" value="{{ old('name', $menu->name) }}" type="text" required>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Title</strong></label>
                                        <div class="col-md-12">
                                            <input class="form-control input-lg" name="title" placeholder="" value="{{ old('title', $menu->title) }}" type="text">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">Image</strong></label>
                                        <div class="col-md-12">
                                            <div class="fileinput fileinput-new" data-provides="fileinput">
                                                @if($menu->image)
                                                    <div class="fileinput-new thumbnail" style="width: 400px; height: 220px;" data-trigger="fileinput">
                                                        <img style="width: 400px" src="{{ asset('images/post') }}/{{ $menu->image }}" alt="...">
                                                    </div>
                                                @else
                                                    <div class="fileinput-new thumbnail" style="width: 400px; height: 220px;" data-trigger="fileinput">
                                                        <img style="width: 400px" src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text= Image" alt="...">
                                                    </div>
                                                @endif
                                                <div class="fileinput-preview fileinput-exists thumbnail" style="max-width: 400px; max-height: 220px"></div>
                                                <div>
                                                <span class="btn btn-info btn-file">
                                                    <span class="fileinput-new bold uppercase"><i class="fa fa-file-image-o"></i> Select image</span>
                                                    <span class="fileinput-exists bold uppercase"><i class="fa fa-edit"></i> Change</span>
                                                    <input type="file" name="image" accept="image/*">
                                                </span>
                                                    <a href="#" class="btn btn-danger fileinput-exists bold uppercase" data-dismiss="fileinput"><i class="fa fa-trash"></i> Remove</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label class="col-md-12"><strong style="text-transform: uppercase;">CONTENT</strong></label>
                                        <div class="col-md-12">
                                            <textarea id="area1" class="form-control" rows="15" name="description">{{ old('description', $menu->description) }}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <button type="submit" class="btn btn-primary btn-block btn-lg"><i class="fa fa-send"></i> Update MENU</button>
                                    </div>
                                </div>
                            </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script src="{{ asset('admin/js/nicEdit.js') }}"></script>
    <script src="{{ asset('admin/js/bootstrap-fileinput.js') }}"></script>
    <script type="text/javascript">
        bkLib.onDomLoaded(function() {
            new nicEditor({fullPanel : true,iconsPath : '{{ asset('admin/js/nicEditorIcons.gif') }}'}).panelInstance('area1');
        });
    </script>
@endsection
