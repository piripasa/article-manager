@extends('article-manager::layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <a href="{{ route('tag.index') }}"><i class="fa fa-angle-double-left"></i> Back to all  <span>tags</span></a><br><br>

            {{-- Show the errors, if any --}}
            @if ($errors->any())
                <div class="callout callout-danger">
                    <h4>Please fix following errors</h4>
                    <ul>
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            {!! Form::open(['route' => ['tag.update', $tag->id]]) !!}
                {{ csrf_field() }}
                {{ method_field('PATCH') }}

                <div class="panel">
                    <div class="panel-heading">
                        <h3>Edit tag</h3>
                    </div>
                    <div class="panel-body row">
                        <div class="form-group col-md-12">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ $tag->name or old('name') }}" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Slug (URL)</label>
                            <input type="text" name="slug" value="{{ $tag->slug or old('slug') }}" class="form-control">
                            <p class="help-block">Will be automatically generated from your name, if left empty.</p>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success">Save and back</button>
                            </div>
                            <a href="{{ route('tag.index') }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;Cancel</a>
                        </div>
                    </div>
                </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
@endsection