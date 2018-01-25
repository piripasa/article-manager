@extends('artiman::layout')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <h3>Article List <a href="{{ route('article.create') }}" class="btn btn-primary btn-sm">Create New</a></h3>
                    </div>
                    <div class="panel-body table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Featured</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($all as $item)
                                <tr>
                                    <td>{{ $item->title }}</td>
                                    <td>{{ $item->status }}</td>
                                    <td>{{ $item->date }}</td>
                                    <td>{{ $item->featured ? 'Yes' : 'No' }}</td>
                                    <td>
                                        <a href="{{ route('article.edit', $item->id) }}" class="btn btn-primary">Edit</a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                        {{ $all->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection