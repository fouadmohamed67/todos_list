@extends('layouts.app')

@section('content')
<div class="m-5">
    <div class="card card-default">
        <div class="card-header">
            {{ isset($todo) ? "Update todo" : "Add a new todo" }}
        </div>
        <div class="card-body col-md-8">
        <form action="{{ isset($todo) ? route('todos.update', $todo->id) : route('todos.store') }}" method="POST">
                @csrf
                @if (isset($todo))
                    @method('PUT')
                @endif
                <div class="form-group">
                    <label for="category">todo title:</label>
                <input type="text" name="title" class="form-control" placeholder="Add a new todo" value="{{ isset($todo) ? $todo->title : old('title') }}">
                    @error('title')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror
                </div>

                <div class="form-group">
                    <label >content</label>
                    <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" placeholder="enter content todo" name="content">{{ isset($todo) ? $todo->content : old('content') }}</textarea>
                </div>
                 @error('content')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                <div class="form-group row">
                    <label for="example-datetime-local-input" class="col-2 col-form-label">deadline</label>
                    <div class="col-10"> 
                        <input class="form-control" type="datetime-local" value="{{ isset($todo) ? $todo->deadline->format('Y-m-d').'T'.$todo->deadline->format('H:m:s') : old('deadline') }}"   name="deadline">
                    </div>
                </div>
                @error('deadline')
                        <div class="alert alert-danger">
                            {{ $message }}
                        </div>
                    @enderror

                <div class="form-group">
                    <button class="btn btn-success">
                        {{ isset($todo) ? "Update" : "Add" }}
                    </button>
                </div>
            </form>
        </div>
    </div>
    </div>
@endsection