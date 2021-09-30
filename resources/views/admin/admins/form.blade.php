@extends('layouts.app')

@section('content')
    <div class="content">

        <div class="card-header">
            <h3 class="card-title">{{ $admin->id ? $admin->name : 'Create New Admin' }}</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form method="post"
            action="{{ is_null($admin->id) ? route('admin.admins.store') : route('admin.admins.update', $admin->id) }}">
            @csrf

            @if (!is_null($admin->id))
                @method('put')
            @endif

            <div class="card-body">

                <div class="form-group">
                    <label for="name">Name</label>
                    <input type="text" class="form-control" name="name" id="name" placeholder="Enter name"
                        value="{{ old('name') ? old('name') : $admin->name }}">
                </div>

                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="text" class="form-control" name="email" id="email" placeholder="Email"
                        value="{{ old('email') ? old('email') : $admin->email }}">
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
