@extends('layouts.layout')
@extends('layouts.navbar')
@section('content')
    <div class="container mt-3">
        <div id="alertInfo"></div>
        <h3 class="mb-4">My Meeting</h3>
        <button id="addStudentBtn" type="button" class="btn btn-primary">
            <i class="fa-solid fa-plus me-1"></i> Create Meeting
        </button>
        <table id="studentTable" class="table table-light table-striped mt-4 text-center">
            <thead>
                <th>#</th>
                <th>Name</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>Meeting Room</td>
                    <td>
                        <button type="button" class="btn btn-sm btn-info me-2 view-btn">
                            <i class="fa-solid fa-eye"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-warning me-2 edit-btn">
                            <i class="fa-solid fa-pen"></i>
                        </button>
                        <button type="button" class="btn btn-sm btn-danger delete-btn">
                            <i class="fa-solid fa-trash-can"></i>
                        </button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
