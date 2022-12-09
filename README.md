# zadanie_rekrutacyjne_marek_kukulski
Otwórzyć przeglądarke:
http://localhost:8080/lista

Przekierowanie do http://localhost:8080/sign-in ponieważ nalezy się zalogować
Lecz jeśli nie posiadamy konta to nalezy przejść pod http://localhost:8080/register

Przykładowe dane:
zxcvbnm@gmail.pl
zxcvbnm
Zaznaczyć Agree terms

Następnie zalogowac się na podane wcześniej dane, na podstronie /lista można przegladać i usuwac wszystkie rekordy z bazy.

testowanie api, można wykonac to przez postamana pod adresem:
http://localhost:8080/api/posts

Lub przejść pod http://localhost:8080/api w przeglądarce i wybrać pierwszego Geta odpowiedzialnego za liste postów, następnie 'Try it out' i 'Execute'

Powyższe porty zostały ustawione w docker-compose oraz w env.local w przypadku zajętych portów należy skorzystać z wolnych portów i wziąć pod uwagę przy kolejnych krokach gdzie wykorzystuje sie porty.


Sprawdzenie postów zapisanych w bazie jeśli korzystamy z lini poleceń:

docker exec -it database bash
mysql -u root -p symfony_docker
secret
show databases;
use symfony_docker;
show tables;
select * from post;