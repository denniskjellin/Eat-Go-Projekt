# Webbtjänst för Eat & Go
av Dennis Kjellin, dekj2100@student.miun.se
Projektuppgift för kursen Webbutveckling III, Mittunivesitetet Sundsvall.

## Info om webbtjänsten
Denna webbtjänst har jag sammanställt för projektet i Webbutveckling III. Jag valde att skapa en restaurang som ska figurera som ett lunchställe som har en ny meny för varje vecka. Här ska det gå att se menyn för aktuell vecka samt att boka bord och på något vis kunna kontakta restaurangen. 
Länk till front-end sidan: http://studenter.miun.se/~dekj2100/Eat&Go/index.html

Lägga till, ta bort eller ändra en meny samt reservering ska gå att göra genom ett admin-gränssnitt som är kopplat till den publika webbplatsen. Allt detta ska lagras i en databas. Så för att uppnå detta så ska admin-sidan och den publika webbsidan konsumera denna webbtjänst.

## Installation
För att ladda ner repot:
"git clone https://github.com/Webbutvecklings-programmet/projekt_webservice_vt22-denniskjellin.git"

Koden är utformad i PHP, så du kommer att behöva att ladda upp filerna på en webbserver som har stöd för PHP för att det ska fungera, en databas anslutning behöver också finnas tillgänglig. Jag använde mig utav XAMPP när jag utvecklade denna databas via Localhost. Innan du kör installationsfilen så kommer du att behöva gå in i "config.php" och ange dina uppgifter för att få den kopplad mot just din databas.

Efter att du gjort det, så kör du filen "install.php" i webbläsarfönstret och databasen och dess tabeller kommer att installeras. Två användare kommer att skapas automatiskt vid installation av databasen, en som heter admin och en som heter Dennis - som är skaparen av denna webbtjänst. Du kan enkelt ändra namn på dessa till något som passar dig!

## Tabeller som installeras

|Tabell|Kolumn  |
|--|--|
|reservations  | **id** (int(11) PRIMARY KEY AUTO_INCREMENT, **date** DATE, **time** VARCHAR(64), **phonenum** (varchar(22), **persons** INT(11), **created** timestamp NOT NULL DEFAULT current_timestamp() |

|Tabell|Kolumn  |
|--|--|
|user  | **id** (int(11) PRIMARY KEY AUTO_INCREMENT, **username** VARCHAR(64) UNIQUE NOT NULL, **password** password VARCHAR(256), **created** timestamp NOT NULL DEFAULT current_timestamp() |

|Tabell|Kolumn  |
|--|--|
|weekmenu  | **id** (int(11) PRIMARY KEY AUTO_INCREMENT, **week** INT(2) NOT NULL, **title** VARCHAR(128) NOT NULL, **content** TEXT NOT NULL, **year** INT(4) NOT NULL, **created** timestamp NOT NULL DEFAULT current_timestamp() |

## Klasser och dess metoder
### Email.class
#### Properties
* $name - namn på avsändaren
* $subject - ämne
* $msg - meddelande
* $email - avsändarens e-post

#### Metoder i klassen
* setName(): bool - kontrollerar så att namn finns
* setEmail(): bool - kontrollerar så e-mail finns
* setSubject(): bool - kontrollerar så att ämne finns
* setMsg(): bool - kontrollerar så att meddelande finns
* postEmail(): bool - skickar meddelande

******

### Reservation.class
#### Properties
* $db - Anslutning med MySQLI
* $date - datum
* $time - tid
* $phonenum - telefonnummer
* $name - namn
* $persons - antal personer

#### Metoder i klassen
* __construct() - innehåller databaskoppling
* addRes(): bool - lägger till reservation
* updateRes(): bool - uppdatering av reservation
* getResById(): array - hämtar reservering med angivet ID
* getRes(): array - hämtar reservationer
* setDate(): bool - kontrollerar så datum är satt
* setTime(): bool - kontrollerar så tid är satt
* setPhonenum(): bool - kontrollerar så telnmr är satt
* setName(): bool - kontrollerar så namn är satt
* setPersons(): bool - kontrollerar så antal personer är satt
* deleteRes(): bool - raderar reservation
* destruct();

******

### User.class
#### Properties
* $db - Anslutning med MySQLI
* $username - användarnamn
* $password - lösenord

#### Metoder i klassen
* __construct() - innehåller databaskoppling
* registerUser(): bool - registrerar en användare med hashat password
* loginUser(): bool - loggar in användare, om den finns i databasen
* isLoggedIn(): bool - kollar om username isset
* restricted() - förhindrar en icke inloggad användare åtkomst
* logoutUser() - förstör sessionen
* setUsername(): bool - kontrollerar användarnamnet, att det är ifyllt och längre än 3 tecken
* setPassword(): bool - kontrollerar lösenord, att det är ifyllt och längre än 7 tecken
* userNameTaken(): bool - kontrollerar om användarnamnet redan existerar
* destruct();

******

### Menu.class
#### Properties
* $db - Anslutning med MySQLI
* $title - meny titel
* $id - meny ID
* $week - meny vecka
* $content - innehåll
* $year - årtal

#### Metoder i klassen
* __construct() - innehåller databaskoppling
* addMenu(): bool - lägger till meny
* updateMenu(): bool - uppdaterar meny
* getMenuById(): array - hämtar meny med angivet ID
* getMenuByWeek(): array - hämtar meny med angiven vecka
* getMenus(): array - hämtar samtliga menyer
* deleteMenu(): bool - raderar meny
* setWeek(): bool - kontrollerar att vecka är satt
* setYear(): bool - kontrollerar att år är satt
* setTitle(): bool - kontrollerar att titel är satt
* setContent(): bool - kontrollerar att innehåll är satt
* destruct();

******

## Beskrivning - användning av API

### Email_api.php
| Metod | Ändpunkt | Beskrivning |
| :---         | :---           | :---          |
| POST   |   /email_api.php    |  Skickar e-post  | 

Ett mail-objekt returneras/skickas som JSON med följande struktur:

```
{
   name: "Dennis",
   email: "dekj2100@student.miun.se",
   subject: "Ämne", 
   message: "ditt meddelande"
}
```
*****

### Menu_api.php
| Metod | Ändpunkt | Beskrivning |
| :---         | :---           | :---          |
| GET   | /menu_api.php    | Hämtar alla tillgängliga menyer.    |
| GET     | /menu_api.php?id=       | Hämtar en specifik meny med ID.      |
| POST     | /menu_api.php       |   Lagrar en ny meny, krävs att ett meny-objekt skickas med.    |
| PUT     | /menu_api.php?id=       | Uppdaterar en existerande meny med angivet ID. Kräver att ett meny-objekt skickas med.      |
| DELETE     | menu_api.php?id=      | Raderar en meny med angivet ID.     |

Ett meny-objekt returneras/skickas som JSON med följande struktur:

```
{
   week: "23",
   title: "Vecka 23",
   content: "Innehåll", 
   year: "2022"
}
```
*****

### Reservations_api.php
| Metod | Ändpunkt | Beskrivning |
| :---         | :---           | :---          |
| GET   | /reservations_api.php     | Hämtar alla tillgängliga reservationer.    |
| GET     | /reservations_api.php?id=       | Hämtar en specifik reservation med ID.      |
| POST     | /reservations_api.php       | Lagrar en ny reservation, krävs att res-objekt skickas med.      |
| PUT     | /reservations_api.php?id=       | Uppdaterar en existerande meny med angivet ID.      |
| DELETE     | /reservations_api.php?id=       | Raderar en reservering med angivet ID.      |

Ett reservations-objekt returneras/skickas som JSON med följande struktur:

```
{
   date: "2022-06-05",
   time: "20:00",
   phonenum: "+4673123456", 
   name: "Dennis Kjellin",
   persons : "2"
}
```
*****

### login_api.php
| Metod | Ändpunkt | Beskrivning |
| :---         | :---           | :---          |
| POST   | /login_api.php     | Kontrollerar angivna login uppgifter mot databasen.    |

Ett users-objekt returneras/skickas som JSON med följande struktur:
```
{
   username: 'användare',
   password: 'lösenord'
}
```

### Frågor eller funderingar?
Hör gärna av dig till mig!

### Kontaktuppgifter:
#### mail: dekj2100@student.miun.se
#### mail: denniskjellin@hotmail.com
