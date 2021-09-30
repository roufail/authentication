@extends('layouts.app')

@section('content')
    <div class="content">

        <div class="card-header">
            <h3 class="card-title">{{ $user->id ? $user->name : 'Create New user' }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"
            action="{{ is_null($user->id) ? route('admin.users.store') : route('admin.users.update', $user->id) }}">
            @csrf

            @if (!is_null($user->id))
                @method('put')
            @endif

            <div class="card-body">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"
                        value="{{ old('name') ? old('name') : $user->name }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                        value="{{ old('email') ? old('email') : $user->email }}">
                </div>

                <div class="form-group">
                    <label for="email">Role</label>
                    <input type="text" class="form-control" name="role" id="role" placeholder="Role"
                        value="{{ old('role') ? old('role') : $user->role }}">
                </div>


                <div class=" form-group">
                    <label for="password">Password</label>
                    <input type="password" class="form-control" name="password" id="password" placeholder="Password">
                </div>

                <div class="form-group">
                    <label for="confirm_password">Confirm Password</label>
                    <input type="password" class="form-control" name="confirm_password" id="confirm_password"
                        placeholder="Confirm Password">

                </div>


            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>




    </div>
@endsection
