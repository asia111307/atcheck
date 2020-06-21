@extends('layouts.app')

@section('title') Potwierdź E-Mail @endsection

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Potwierdź swój adres E-Mail') }}</div>

                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('Nowy link weryfikacyjny został wysłany na Twój adres mailowy.') }}
                        </div>
                    @endif

                    {{ __('Zanim przejdziesz dalej, sprawdź swoją skrzynkę mailową.') }}
                    {{ __('Jeśli nie otrzymałeś linka weryfikacyjnego,') }},
                    <form class="d-inline" method="POST" action="{{ route('verification.resend') }}">
                        @csrf
                        <button type="submit" class="btn btn-link p-0 m-0 align-baseline">{{ __('kliknij tutaj, aby wysłać kolejny link.') }}</button>.
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
