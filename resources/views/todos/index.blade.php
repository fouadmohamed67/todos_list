 @extends('layouts.app')

@section('content')
  <div class="m-5">
  <div class="clearfix">

     @if (session()->has('destroy'))
      <div class="alert alert-sucess">
        {{ session()->get('destroy') }}
      </div>
    @endif

    @if (session()->has('success_update'))
      <div class="alert alert-sucess">
        {{ session()->get('success_update') }}
      </div>
    @endif

    @if (session()->has('success_done'))
      <div class="alert alert-sucess">
        {{ session()->get('success_done') }}
      </div>
    @endif

    @if (session()->has('success_store'))
      <div class="alert alert-danger">
        {{ session()->get('success_store') }}
      </div>
    @endif


    <a href="{{ route('todos.create') }}"
    class="btn float btn-success"
    style="margin-bottom: 10px">
      Add todo
    </a>
  </div>
  <div class="card card-default">
         <div class="card-header">todos list</div>
        @if ($todos->count() > 0)
          <div class="card-body">
            <div >
                
                @foreach ($todos as $todo)
                  <div class="center">
                  <div class="card  ">
                    <div class="card-body">
                        <h5 class="card-title">{{ $todo->title }} 
                        @if($todo->done==0)
                        <a href="\make_it_done\{{$todo->id}}"><span class="badge  cursor-pointer float-right badge-success">done?</span></a>
                        @else
                        <i class="fa fa-check"></i>
                        @endif </h5>
                        <p class="card-text">{{ $todo->content }}</p>
                        <h3><div class="badge   badge-secondary" > {{$todo->deadline}}</div></h3>
                       <div class="d-flex flex-row">
                       
                         <a href="{{route('todos.edit',$todo->id)}}" class="btn btn-primary">edit</a>
                         <form  method="POST" class=" form-inline justify-content-center ml-2" action="{{route('todos.destroy' , $todo->id )}}" >
                                @csrf
                                @method('DELETE')
                                <button class="btn btn-danger  ">
                                    Delete
                                </button>
                         </form>
                       </div>
                    </div>
                    </div>
                  </div>
                @endforeach
              </div>
          </div>
        @else
          <div class="card-body">
            <h1 class="text-center">
              No todos Yet.
            </h1>
          </div>
        @endif
    </div>
  </div>
 
  </div>
@endsection
 