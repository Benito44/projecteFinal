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

### Login
- Inici de sessió normal i per Google i Github

- Usuaris per probar
b.martinez2@sapalomera.cat 1234 - Admin
d.vallmanya@gmail.com 123 - Usuari
### Crear Usuaris
- Per part de l'administrador crear usuaris i assignar-li el seu rol (Admin o Usuari)


### Crear Projecte
- Creació de projecte i compartir un projecte amb varis usuaris a la vegada  per la part d'administrador amb correu electronic enviant el link a tots els usuaris.

- Al compartir poder possar permissos específics (Edició total, només comentar o Visualitzar)
### Mostrar Projecte
- Mostrar els projectes de cada propi usuari, l'administrador té permissos totals 
### Calendari
- Calendari per mostrar events dels usuaris

- Eliminar nomès el nostre event sense possibilitat d'eliminar altres que no siguin nostres
### Tascas d'usuaris
- Tasques on pots crear o moure en els diferents apartats

- Actulitzar en la base de dades en el moment que és canvia una tasca de lloc
### Projecte
- Escriure en el projecte amb la possibilitat de veure que està escribint l'altre persona (en viu)

- Xat en viu on és mostra l'usuari que està enviant missatges

- Aplicar a cada projecte la seva pàgina de tasques

- Guardar totes aquestes dades en la base de dades (comentaris, contingut del projecte, usuaris compartits en el projecte...)

- Mostrar per pantalla quanes guarden les dades

- Una vegada inicies la sessió amb un usuari normal, no admin, és mostraran els teus projectes personals i si intentes entrar en un projecte on no ets propietari o no tens permissos és mostrarà un altre pantalla d'error
### Perfil
- Poder canviar el teu nom , email, contrasenya o eliminar el teu usuari
### Desplegament
- Desplegament del projecte amb docker 
    - docker build . -t proj-final
    - docker-compose up -d






## Cosses per fer
- Menu perfecto 
- Boton de cerrar session !!
# Mostrar  projectos 
Cambiar la vista a card por projecto
~~Se canviarà como se muestra el projecto: De primeras solo se mostrara el nombre, pero una vez que se haga clic encima se mostraran todos los datos como el nombre, su descripcion, su fecha de entrega,~~ los usuarios con sus permissos
~~Poner una imagen~~
Boton de cerrar session !!
# Perfil 
~~Estilos y mensaje si estas seguro de que quieres eliminar la cuenta (Contraseña)~~
~~Poner una imagen i cambiar la imagen~~
Boton de cerrar session !!
# Login
Estilos,  ~~Textos incorrectos ~~, ~~Recuperar Contrasenya y ~~ ~~quitar registro~~
~~Encriptar contraseña~~
# Candelario
Mejorar el calendario con estilos y ~~posicionamiento~~
~~Cambiar el idioma~~
~~Poner color a los eventos y descripcion~~
¿¿ Enviar email cuando pase el evento  ??
~~Reposicionamiento de botones: Crear (Mostrar el calendario a dias y semanas) y mover ~~
Poner el menu
~~Poner una imagen~~
Boton de cerrar session !!
# Crear Projecto 
~~Mejorar el formulario de permisos~~
~~Poner una imagen~~
Mejorar el email que se manda al compartir
Boton de cerrar session !!
# Tareas
Dar acceso a las tareas desde cualquier projecto (comentar i visualizar)
~~Poner una imagen~~
Estilos
~~Implementar eliminar tareas (simple)~~
~~Que se muestren las tareas cuando las creas sin tener que actualizar~~
Boton de cerrar session !!
# Projecto
Eliminar boton de enviar, link de login i que el administrador pueda eliminar projectos
Poner el texto del projecto en vertical
Poner el chat en pequeño en una esquina, hacer que si se envia un mensaje cuando esta lleno que vaya directo al mensaje
Mostrar los usuarios que tienen permisos en el projecto por la imagen 
Boton de cerrar session !!
Mostrar les tasques que estiguin en progrès per part de l'usuari i per part de l'administrador que es mostrin les tasques en progrès i per revisar
~~Poner una imagen~~