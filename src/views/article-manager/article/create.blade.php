
@extends('article-manager::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                {!! Form::open(['route' => ['article.store'], 'files' => true]) !!}
                {{ csrf_field() }}
                {{ method_field('POST') }}
                <div class="panel">
                    <div class="panel-heading">
                        <h3>Add a new  article</h3>
                    </div>
                    <div class="panel-body row">
                        @include('article-manager::errors')
                        <div class="form-group col-md-12">
                            <label>Name</label>
                            <input type="text" name="title" value="{{ old('title') }}" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Slug (URL)</label>
                            <input type="text" name="slug" value="{{ old('slug') }}" class="form-control">
                            <p class="help-block">Will be automatically generated from your name, if left empty.</p>
                        </div>
                        <div class="form-group col-md-2">
                            <label>Date</label>
                            <input type="date" name="date" value="{{ old('date') }}" class="form-control">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Content</label>
                            <textarea name="content" rows="6" class="form-control">{{ old('content') }}</textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Image</label>
                            <input type="file" name="image">
                        </div>
                        <div class="form-group col-md-6">
                            <label>Category</label>
                            {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Pick a Category', 'id' => 'category']) !!}
                        </div>
                        <div class="form-group col-md-6">
                            <label>Tags</label>
                            {!! Form::select('tags[]', $tags, null, ['class' => 'form-control', 'multiple' => true, 'id' => 'tags']) !!}
                        </div>
                        <div class="form-group col-md-12">
                            <label>Status</label>
                            <input type="radio" value="PUBLISHED" name="status" checked> Published
                            <input type="radio" value="DRAFT" name="status"> Draft
                        </div>
                        <div class="form-group col-md-12">
                            <div class="checkbox">
                                <label>
                                    <input type="hidden" name="featured" value="0">
                                    <input type="checkbox" value="1" name="featured"> Featured item
                                </label>
                            </div>
                        </div>
                    </div>
                    <div class="panel-footer">
                        <div class="form-group">
                            <div class="btn-group">
                                <button type="submit" class="btn btn-success">Save and back</button>
                            </div>
                            <a href="{{ route('article.index') }}" class="btn btn-default"><span class="fa fa-ban"></span> &nbsp;Cancel</a>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}
            </div>
        </div>
    </div>
@endsection

@section('after_scripts')

    <script>
        $(document).ready(function() {
            $('#category, #tags').select2();
        });
    </script>

@endsection