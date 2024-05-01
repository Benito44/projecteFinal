# projecteFinal
Aquest projecte consisteix en desenvolupar una plataforma web de gestió de projectes
col·laboratius.
La plataforma estarà dissenyada per facilitar la coordinació i col·laboració entre equips de
treball en els àmbits de la planificació, execució, i seguiment de projectes. La página permetrà
als administradors asignar diferents rols als usuaris i poder veure en tot moment el treball
realitzat i aplicar-hi tasques amb diferents estats de priotitats per els usuaris.
També permet als usuaris treballar en grup en els projectes, poder comunicar-se entre ells
mitjançant comentaris dintre del projecte i planificar el temps de la duració del treball realitzat
el qual els será de gran ajuda per informar als administradors

Requeriments Funcionals:
La plataforma ha de permetre als usuaris crear i gestionar projectes.
Els administradors han de poder assignar tasques a membres de l'equip i establir dates límit.
Cal permetre la col·laboració en temps real mitjançant comentaris i missatges dins de cada
tasca.
La plataforma ha de proporcionar eines visuals per visualitzar el progrés del projecte.
Heu de ser possible gestionar usuaris i rols, assignant diferents nivells d'accés segons les
responsabilitats de cada usuari.
- Requeriments Tècnics:
El desenvolupament del backend es realitzarà a PHP.
El frontend s'implementarà amb JavaScript, HTML i CSS, amb possibles implementacions com
ara Bootstrap
Es farà ús d'una base de dades relacional com MySQL per emmagatzemar la informació de
projectes, tasques i usuaris.

## Fet: 
- Inici de sessió amb administrador i usuari

- Creació de projecte i compartir un projecte amb un usuarai per la part d'administrador amb correu electronic enviant el link.

- Escriure en el projecte amb la possibilitat de veure que està escribint l'altre persona (en viu)

- Xat en viu on és mostra l'usuari que està enviant missatges

- Guardar totes aquestes dades en la base de dades (comentaris, contingut del projecte, usuaris compartits en el projecte...)

- Tasques on pots crear o moure en els diferents apartats

- Una vegada inicies la sessió amb un usuari normal, no admin, és mostraran els teus projectes personals i si intentes entrar en un projecte on no ets propietari o no tens permissos és mostrarà un altre pantalla d'error

- Desplegament del projecte amb docker 
docker build . -t proj-act-cohesio
docker-compose up -d
## Cosses per fer

- Aplicar a cada projecte la seva pàgina de tasques
- ~~Afeguir la part de permissos de només lectura, edició i només comentari~~
- Fer que l'administrador pugui veure en tots els projectes
- ~~ Perfils dels usuaris~~
