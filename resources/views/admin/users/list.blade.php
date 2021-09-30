@extends('layouts.app')

@push('css-files')
    <link rel="stylesheet" href="{{ asset('admin-assets/css/sweetalert2.min.css') }}">
@endpush

@section('content')

    <div class="content">
        <div class="float-right">
            <a href="{{ route('admin.users.create') }}"><i class="fas fa-plus"></i></a>
        </div>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            <a class="btn btn-primary float-left" href="{{ route('admin.users.edit', $user->id) }}"><i
                                    class="fas fa-edit"></i></a>

                            <div class="ms-1"></div>
                            <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}">
                                @csrf
                                @method('delete')
                                <button class="delete-btn btn btn-primary float-left" href="#"><i
                                        class="fas fa-trash-alt"></i></button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
            {{-- <tfoot>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Role</th>
                    <th>Actions</th>
                </tr>
            </tfoot> --}}
        </table>
        <div>
            {{ $users->render('layouts.partials.pagination') }}
        </div>
    </div>
@endsection

@push('js-files')
    <script src="{{ asset('admin-assets/js/sweetalert2.all.min.js') }}"></script>
@endpush


@section('js-extra')
    <script>
        jQuery(function($) {
            $('.delete-btn').click(function($event) {
                $event.preventDefault();

                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        $(this).closest('form').submit();
                    }
                })


            });
        })
    </script>
@endsection
