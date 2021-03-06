@extends('admin.layouts.app')
@section('content')
<div class="card">
    <div class="card-header">
        {{$title}}
        <a href="{{route('categories.create')}}" class="btn btn-success float-right">
            <i class="fa fa-plus"></i> New
        </a>
    </div>
    <div class="card-body">
        @if(count($categories))
           <table class="table table-hover table-striped table-light">
               <thead class="thead-dark">
                   <tr>
                       <th>Name</th>
                       <th>Action</th>
                   </tr>
               </thead>
               @foreach($categories as $category)
                   <tr>
                       <td style="width: 70%">{{$category->name}}</td>
                       <td>
                           <a href="{{route('categories.show', $category->slug)}}" class="btn btn-success">
                               <i class="fa fa-eye"></i>
                           </a>
                           <a href="{{route('categories.edit', $category->slug)}}" class="btn btn-primary">
                               <i class="fa fa-edit"></i>
                           </a>
                           <button  data-toggle="modal" data-target="#deleteModal" class="btn btn-danger">
                               <i class="fa fa-trash"></i>
                           </button>
                           <form method="POST" action="{{route('categories.destroy', $category->slug)}}" id="deleteCategoryForm">
                               @csrf
                               {{method_field('DELETE')}}
                           </form>
                       </td>
                   </tr>
               @endforeach
           </table>

            {{$categories->links()}}
        @else
        <div class="alert alert-danger">
            Categories table is empty !
        </div>
        @endforelse
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Are You Sure To Delete This Category ?</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                Remember that if you deleted this category the news for this category will
                be deleted also.
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-danger" id="confirmDeleteBtn">I'am Sure</button>
            </div>
        </div>
    </div>
</div>

@endsection

@push('js')
    <script>
        $(document).ready(function () {
            $("#confirmDeleteBtn").on('click', function(){
                $("#deleteCategoryForm").submit();
            });
        });
    </script>
@endpush