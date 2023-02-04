---------------INSTALACJA I URUCHAMIANIE--------------------

1. Aby uruchomić aplikację należy pobrać PHP w wersji 8.1.12 lub wyższej. PHP jest częścią programu Xampp, który również przyda się do uruchomienia aplikacji - https://www.apachefriends.org/pl/download.html

2. Następnie trzeba zainstalować Composer w wersji 2.4.2 lub wyższej - https://getcomposer.org/download/

3. Instalujemy Node.js w wersji 8.19.2 lub wyższej - https://nodejs.org/en/download/

4. W Xampp uruchamiamy Apache i MySQL.

5. Otwieramy przeglądarkę i wchodzimy w adres localhost/phpmyadmin/

6. Tworzymy pustą bazę danych o nazwie ogloszenia_reklamowe i importujemy do niej plik ogloszenia_reklamowe.sql.

7. W korzeniu projektu znajduje się plik .env.example, zmieniamy jego nazwę na .env.

8. Do pełnego działania aplikacji zalecane jest dodanie w pliku .env danych konfiguracyjnych do skrzynki pocztowej, z której aplikacja będzie mogła wysyłać wiadomości email. Bez tego aplikacja może wyrzucać błędy przy niektórych akcjach (np. rejestracja i reset hasła). Błędy te można zignorować i zasymulować weryfikację maila poprzez modyfikację użytkownika w bazie danych.

9. W plikach projektu przechodzimy do folderu /public/przykładowe_zdjęcia i przenosimy jego zawartość do /public/images.

10. Otwieramy 2 okna terminala w głównym folderze projektu. Na jednym wpisujemy komendę "php artisan serve", a na drugim "npm run dev".

11. W przeglądarce przechodzimy pod adres localhost:8000/

12. Jeśli wszystko zostało ustawione poprawnie powinniśmy zobaczyć stronę główną aplikacji.

---------------KONTA TESTOWE--------------------

login: kamil.slimak@ggwp.pl
hasło: Lol123123
opis: user zweryfikowany i niezablokowany, posiada dodane 2 ogłoszenia

login: tad.kaczmarek@mail.com
hasło: Lol123123
opis: user zweryfikowany i niezablokowany, posiada dodane 2 ogłoszenia

login: admin@adlistings.com
hasło: Admin123123
opis: admin zweryfikowany i niezablokowany, nie posiada ogłoszeń

login: nieistniejacy@mail.br
hasło: Lol123123
opis: user niezweryfikowany i niezablokowany, nie posiada ogłoszeń

login: banned@mail.com
hasło: Lol123123
opis: user zweryfikowany i zablokowany, nie posiada ogłoszeń