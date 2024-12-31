

## API Coduri Postale si interfata basic

## Instructiuni instalare

`git clone https://github.com/tudorr89/coduri-postale-api.git`

`cp .env.example .env`

`php artisan key:generate`

`php artisan app:import` - se populeaza db sqlite cu fisierul infocod.xls din datagov

`npm install`

`npm run dev`

`php artisan serve`

Interfata web disponibila pe http://localhost

API info cod postal disponibil pe http://localhost/api/v1/info?zipcode=XXXXXX

sau

Cautare cod postal dupa judet/oras/strada/numar pe http://localhost/api/v1/?county=Bucuresti&city=Bucuresti&street=Eroilor&number=12

Doar judet si oras sunt obligatorii!
