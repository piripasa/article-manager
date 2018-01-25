@extends('artiman::layout')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            {!! Form::open(['route' => ['category.store']]) !!}
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="panel">
                    <div class="panel-heading">
                        <h3>Add a new  category</h3>
                    </div>
                    <div class="panel-body row">
                        @include('artiman::errors')
                        <div class="form-group col-md-12">
                            <label>Name</label>
                            <input type="text" name="name" value="{{ old('name') }}" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Slug (URL)</label>
                            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                            <p class="help-block">Will be automatically generated from your name, if left empty.</p>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Parent</label>
                            {!! Form::select('parent_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Pick a Category']) !!}
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success">Save and back</button>
                            </div>
                            <a href="{{ route('category.index') }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;Cancel</a>
                        </div>
                    </div>
                </div>
            {{ Form::close() }}
        </div>
    </div>
</div>
@endsection