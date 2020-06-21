@extends('layouts.app')

@section('title') Strona Główna @endsection

@section('content')
    @auth
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-body no-margin-top">
                            @if (session('status'))
                                <div class="alert alert-success" role="alert">
                                    {{ session('status') }}
                                </div>
                            @endif
                            @section('user_content')
                                <h4> Garść przydatnych informacji </h4>
                                    <p> W zakładce <a href="{{ route('user_subjects') }}"> <b>Moje przedmioty</b> </a> znajdują się przedmioty, których jesteś prowadzącym.
                                    <br>Przedmioty możesz grupować i usuwać. Możesz także dodać nowy przedmiot. Nazwa przedmiotu musi być unikalna (w całym systemie).
                                </p>
                                <p></p>
                                <p> Sprawdzanie obecności możesz rozpocząć w zakładce <a href="{{ route('user_classes') }}"><b>Sprawdź obecność</b></a>.
                                    <br> W <b>trybe egzaminu</b> studenci nie będą sami wybierać sobie miejsc, lecz miejsca zostaną im przydzielone w sposób losowy i pokazane na mapie.
                                    <br> W <b>trybe szybkim</b> sprawdzana jest sama obecność, bez przypisywania miejsc (bez mapy).
                                    <br> Po rozpoczęciu zapisów zostanie wygenerowany i wyświetlony na ekranie <b>kod weryfikacyjny</b>.
                                    Należy go wprowadzić do programu obsługującego odczyt danych z legitymacji studenckich.
                                    Kod jest ważny 1,5 godziny od momentu utworzenia zajęć.
                                    <br> Od tego momentu można rozpocząć proces sprawdzania obecności poprzez wprowadzanie legitymacji do czytnika. W razie potrzeby istnieje także możliwośc manualnego dodania obecności (na przykład w przypadku braku czytnika, braku legitymacji czy problemów technicznych).
                                    Dopóki kod jest aktywny, zapisy można przerywać i ponownie kontynuować, gdy zajdzie taka potrzeba.
                                    <br> Jeśli limit miejsc w sali zostanie osiągnięty, to każda kolejna osoba będzie wciąż miała możliwość zarejestrowania swojej obecności na zajęciach, lecz nie zostanie do niej przypisane żadne miejsce siedzące.
                                    <br> W tej zakładce znajdziesz także listę wszystkich minionych zajęć.
                                    <br> W każdym momencie możesz zobaczyć <b>podgląd sali</b> i listę obecności dla konkretnych zajęć. Taką listę możesz sortować i wyeksportować do formatu xlsx. Przy każdej mapie sali wyświetlony jest opis perspektywy, zgodnie z którą rozmieszczone są numery na mapie.
                                </p>
                                <p>
                                    Dane dotyczące obecności znajdziesz także w zakładce <a href="{{ route('user_attendances') }}"><b>Obecności</b></a>.
                                    <br> Do każdej obecności możesz dodać <b>notatkę</b> i ją później edytować.
                                    <br> Rekordy dotyczące wszystkich obecności możesz grupować i wyeksportować. Przy eksporcie każda tabela-grupa trafi do pliku xlsx jako osobny arkusz.
                                </p>
                                <p>
                                    <b> Z racji charakteru systemu, który bazuje na integracji z zewnętrznym czytnikiem i mapą sali, rekomendowane jest korzystanie z programu w trybie desktopowym, a nie mobilnym. </b>
                                </p>
                            @endsection
                            @yield('user_content')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @else
        <div class="container flex-center">
            <div class="row justify-content-center">
                <div class="flex-center position-ref">
                    <div class="content">
                        <div class="title">
                            @CHECK
                        </div>
                        <h2>Witaj!</h2>
                    </div>
                </div>
            </div>
        </div>
    @endauth
@endsection
