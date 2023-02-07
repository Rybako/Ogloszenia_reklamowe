---------------INSTALACJA I URUCHAMIANIE--------------------

1. Pobieramy folder główny projektu - https://github.com/Rybako/Ogloszenia_reklamowe

2. Aby uruchomić aplikację należy pobrać PHP w wersji 8.1.12 lub wyższej. PHP jest częścią programu Xampp, który również przyda się do uruchomienia aplikacji - https://www.apachefriends.org/pl/download.html

3. Instalujemy Node.js w wersji 8.19.2 lub wyższej - https://nodejs.org/en/download/

4. Uruchamiamy Xampp i uruchamiamy w nim Apache i MySQL.

5. Otwieramy przeglądarkę i wchodzimy w adres localhost/phpmyadmin/

6. Tworzymy pustą bazę danych o nazwie ogloszenia_reklamowe i importujemy do niej plik ogloszenia_reklamowe.sql

7. W korzeniu projektu znajduje się plik .env.example, zmieniamy jego nazwę na .env

8. W folderze projektu przechodzimy do folderu /public i zmieniamy nazwę folderu przykładowe_zdjęcia na images.

9. Przechodzimy do zaawansowanych ustawień systemu windows > zmienne środowiskowe > PATH > dodajemy tam wpis ze ścieżką do folderu zawierającego nasz plik php.exe (np. C:\xampp\php)

10. Otwieramy okno terminala w głównym folderze projektu i wpisujemy "npm install", następnie wpisujemy "npm run dev". Pozostawiamy to okno terminala otwarte.

11. Otwieramy drugie okno terminala w głównym folderze projektu i wpisujemy komendę "php artisan key:generate", następnie wpisujemy "php artisan serve". To okno również trzeba pozostawić otwarte

12. Do pełnego działania aplikacji zalecane jest dodanie w pliku .env danych konfiguracyjnych do skrzynki pocztowej, z której aplikacja będzie mogła wysyłać wiadomości email. Bez tego aplikacja będzie wyrzucać błędy krytyczne przy niektórych akcjach (rejestracja, próba resetowania hasła i wysyłanie wiadomości weryfikacyjnej).

- Błąd podczas rejestracji można zignorować i wrócić do strony głównej (konto zostanie poprawnie utworzone, jedynie wiadomość weryfikacyjna nie zostanie wysłana). Nie nastąpi automatyczne logowanie więc trzeba zrobić to ręcznie.
- Podobny błąd wystąpi przy próbie resetowania hasła.
- Brak możliwości weryfkacji konta można obejść poprzez modyfikację użytkownika w bazie danych (wpisanie dowolnej daty w polu email_verified_at w tabeli users).

13. Do pełnego działania aplikacji wymagane jest również posiadanie własnego klucza Google Maps API. Klucz należy dopisać w pliku .env (GOOGLE_MAPS_API_KEY=MÓJ_KLUCZ_API). Instrucje dotyczące otrzymania klucza znajdują się pod linkiem - https://developers.google.com/maps/documentation/javascript/get-api-key?hl=pl

- Pomijając ten punkt nie będziemy w stanie dodać na stronie żadnego ogłoszenia, ponieważ podanie adresu jest niezbędne do tworzenia ogłoszeń.
- Problem można obejść edytując plik resources\views\listing_item\create.blade.php - należy zakomentować lub całkowice usunąć sekcję <script> w linijkach 207 - 226

14. W przeglądarce przechodzimy pod adres localhost:8000/

15. Jeśli wszystko zostało ustawione poprawnie powinniśmy zobaczyć stronę główną aplikacji.

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