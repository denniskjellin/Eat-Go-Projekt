# Front-end sida för Eat & Go
av Dennis Kjellin, dekj2100@student.miun.se
Projektuppgift för kursen Webbutveckling III, Mittunivesitetet Sundsvall.

### Info om front-end sidan
Denna webbsida innehåller ett fiktivt företag som jag valt att döpa till Eat & Go.
Eat & Go ska föreställa en lunchrestaurang som har diverse maträtter och en mixad meny från vecka till vecka. Den grafiska profilen och logotypen är helt och hållet skapat av mig, eventuella likheter är en slump.

Webbsidan är utvecklas i min skräddarsydda GULP/NPM paket. Där SCSS/SASS används för CSS styling genom ett konstruerat SCSS/SASS(länk till guide nedan) bibliotek som innehåller en hel del klasser för design och responsivitet.

### För att bygga det SCSS/SASS bliblioteket som jag byggt
https://www.youtube.com/watch?v=_kqN4hl9bGc&list=PL4cUxeGkcC9jxJX7vojNVK-o8ubDZEcNb&ab_channel=TheNetNinja

* Kanal: The Net Ninja
* Författare/Skapare: The Net Ninja

Använder TypeScript som sedan transpileras till JavaScript. TypeScript koden är uppdelad i flera moduler för att få en mer stilren och struktrurerad kod.

### Kommunicerar med webbtjänst
Front-end sidan kommunicerar med en webbtjänst som jag skapat i en annan del av denna uppgift, detta görs genom fetch anrop. Vilket adderar dynamisk funktionalitet till webbsida, samt att det finns möjlighet att utföra bokningar och att skicka mail genom kontaktformuläret.

### NPM paket

* @babel/preset-env: "^7.16.11",
* browser-sync: "^2.27.9",
* gulp: "^4.0.2",
* gulp-babel: "^8.0.0",
* gulp-concat: "^2.6.1",
* gulp-imagemin": "^7.1.0",
* gulp-sass: "^5.1.0",
* gulp-uglify-es: "^3.0.0",
* node-sass: "^7.0.1",
* sass: "^1.49.11",
* typescript: "^4.6.3"        
* gulp-sourcemaps: "^3.0.0",
* gulp-typescript: "^6.0.0-alpha.1",
* gulp-uglifycss: "^1.1.0"

### Kontaktuppgifter:
#### mail: dekj2100@student.miun.se
#### mail: denniskjellin@hotmail.com


