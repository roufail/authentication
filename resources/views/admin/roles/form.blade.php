@extends('layouts.app')

@section('content')
    <div class="content">

        <div class="card-header">
            <h3 class="card-title">{{ $role->id ? $role->name : 'Create New Role' }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"
            action="{{ is_null($role->id) ? route('admin.roles.store') : route('admin.roles.update', $role->id) }}">
            @csrf

            @if (!is_null($role->id))
                @method('put')
            @endif

            <div class="card-body">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"
                        value="{{ old('name') ? old('name') : $role->name }}">
                </div>



                <div class="form-group">
                    <label for="options">Options</label>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="permissions[]" type="checkbox" id="create_topic"
                            value="create-topic" @if (in_array('create-topic', $permissions)) checked @endif>
                        <label class="form-check-label" for="create_topic">Create Topic</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="permissions[]" type="checkbox" id="edit_topic"
                            value="edit-topic" @if (in_array('edit-topic', $permissions)) checked @endif>
                        <label class="form-check-label" for="edit_topic">Edit Topic</label>
                    </div>


                    <div class="form-check form-check-inline">
                        <input class="form-check-input" name="permissions[]" type="checkbox" id="delete_topic"
                            value="delete-topic" @if (in_array('delete-topic', $permissions)) checked @endif>
                        <label class="form-check-label" for="delete_topic">Delete Topic</label>
                    </div>

                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>




    </div>
@endsection
