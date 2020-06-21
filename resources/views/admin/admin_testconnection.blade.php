@extends('layouts.adminpanel')

@section('title') Panel admina - Test requesta @endsection

@section('admin_content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <form method="POST" action="{{ route('user_start_classes_verified') }}">
                <label for="classes_code"> Kod: </label>
                <input type="text" name="classes_code" id="classes_code">

                <label for="student_id_number"> ID studenta: </label>
                <input type="text" name="student_id_number" id="student_id_number">

                <label for="student_name"> Imię studenta: </label>
                <input type="text" name="student_name" id="student_name">

                <label for="student_surname"> Nazwisko studenta: </label>
                <input type="text" name="student_surname" id="student_surname">

                <button type="submit"> Test requesta </button>
            </form>
        </div>
    </div>
@endsection
