***JUEGO QR PARA LA JORNADA DE PUERTAS ABIERTAS***



¿DE QUÉ VA EL JUEGO?
====================

		-> Explicación general
			
			El juego es sencillo. Te registras en el mostrador de Informática y debes ir consiguiendo puntos para conseguir un premio (una camiseta, por ejemplo). Además, habrá un ranking donde salgan los usuarios con más puntos y tal.

		-> Puntuaciones

			Las puntuaciones serán: 

					- PERSONA: 75pts
					- PUESTO: 25pts
					- PEGATINAS ESCONDIDAS: 100pts

			Y hay que obtener un mínimo de 300pts (visitar 12 puestos, encontrar 3 pegatinas escondidas, disparar a 4 personas o cualquier permutación de las anteriores).

		-> Tecnologías usadas:

			HTML, CSS, PHP, (MySQL/SQLite)?, JS?


DIRECTORIOS
===========
	
	Dependiendo de la ruta que se visite en la web (www.qea.me/(ruta)), se hacen varias acciones.

		/ (directorio raíz) -> página explicativa de la actividad con enlace a la página para obtener lector QR

		/ranking -> ranking. No hay más.

		/getReader -> página que redirigirá a la store correspondiente dependiendo del SO para obtener un QR

		/admin -> Entrada al panel de administración. Aquí se registra a la gente, y se generan los QRs para hacer las pegatinas (de usuarios y de cosas).

				CÓMO ES EL REGISTRO:

				1. Se pide un nickname (preferentemente nombre de usuario de tuiter), y un teléfono para contactar en caso de que gane algo.
				2. Se registra en la base de datos y se devuelve un QR con un enlace a /admin/enroll/#codigo, donde #codigo es la id del usuario en la BD, y otro QR con un enlace a /whoami

		/register/#codigo -> registra a quien visite esta página una cookie donde le identifique como el usuario id= #código y le da una confirmación

		/user -> esta página es para probar que la cookie se ha registrado, y para que cada usuario vea su puntuación. Se cierra el navegador después de registrarse con el QR de Registro y se abre esta página para comprobar que es la persona que acabamos de registrar.

		/shoot/#codigo -> quien visita esta página ha disparado al QR de un sitio, persona u/o lugar y gana X puntos. Si ha sido a una persona, se muestra su dirección de twitter (si esta está configurada)

				#Cada vez que se efectua un disparo añadiremos una entrada a la BD shoots con la id del que ha disparado y la id de lo que ha sido disparado (si este id es de un lugar, el bool person será cero, y si es una persona, uno).

BASES DE DATOS
==============

		players -> id [int] user[varchar30] phone[varchar15] twitter[boolean]

			#id: id de usuario autonumérico 
			#user: nick de twitter o nickname 
			#phone: número de teléfono
			#twitter: si el user es un nick de twitter, es true

		places -> id[int] name[varchar30]

			#id-> id de lugar autonumérico 
			#name->descripción del lugar

		shoots -> user[int] shoot[int] score[int]

			#user-> id del usuario que ha disparado
			#shoot-> id del objeto/persona disparado(a)
			#score-> puntos que ha ganado con el disparo al objeto/persona

		codes -> id[int] type[int] code[varchar32]

			#id-> id del QR
			#type-> tipo (1=persona, 2=puesto, 3=escondido)
			#code-> código dentro del QR

TODO
====
		
		INSTALA UN SERVIDOR PARA PROBAR EN TU MÁQUINA LOCAL (http://www.apachefriends.org/es/xampp.html)
		NO USES la extensión .html, sino .php (AUNQUE TU DOCUMENTO TENGA SÓLO HTML)

		-[ ]: BUSCAR LECTORES QR (que funcionen OFFLINE)
					
					- [x]:	iOS: QRReader (https://itunes.apple.com/us/app/qr-reader-for-iphone/id368494609?mt=8)
					- [ ]:	Android:
					- [ ]:	Windows Phone: 


		-[SQL/PHP/JS]

			-[ ]: CREAR ESTRUCTURA BASE DE DATOS (el query que hay que hacer, por ejemplo: CREATE TABLE players……)
			-[ ]: MÉTODOS PARA CONECTAR CON LA BD Y HACER QUERYs
			-[ ]: CREAR FUNCIONES NECESARIAS PARA LAS SIGUIENTES TAREAS:
				-[ ]: RESETEAR TABLAS PLAYERS/SHOOTS (DROP TABLE y luego CREATE TABLE, por ejemplo)
				-[ ]: AÑADIR UN JUGADOR
				-[ ]: AÑADIR UN LUGAR
				-[ ]: OBTENER UNA LISTA DE LUGARES
				-[ ]: OBTENER UNA LISTA DE JUGADORES
				-[ ]: OBTENER UNA LISTA DE DISPAROS (shoots) DE UN JUGADOR Y SUMAR SU PUNTUACIÓN
				-[ ]: OBTENER LA LISTA DE TODOS LOS JUGADORES Y DE TODOS LOS DISPAROS, SUMAR LAS PUNTUACIONES DE TODOS LOS JUGADORES Y ORDENARLAS (Crear ranking)
				-[ ]: EFECTUAR DISPARO (anotar codigo en la tabla shoots, buscar la relación entre el código y lugar en la tabla codes y devolver un array con la puntuación, información sobre el )
				-[ ]: AÑADIR UN REGISTRO A LA LISTA DISPAROS
			-[ ]: CREA UNA FUNCIÓN QUE INTRODUZCA DATOS DE PRUEBA (LLAMANDO A LAS FUNCIONES DISEÑADAS ANTERIORMENTE)

			-[ ]: [/getReader/index.php] HACER QUE LA PÁGINA REDIRIJA A CADA USUARIO A LA WEB DONDE PUEDE DESCARGAR CADA LECTOR QR (si hay manera de hacer que se abra en su store, guay)
			-[ ]: [/ranking/index.php] REPRESENTAR EL RANKING
			-[ ]: [/ranking/index.php][JS/HTML] HACER QUE LA PÁGINA SE ACTUALICE CADA x TIEMPO
			-[ ]: [/register/#codigo] GUARDA UNA COOKIE DE 7 HORAS CON EL CÓDIGO DE USUARIO


		-[HTML/CSS]
			
			-[ ]: CREAR UNA “PLANTILLA” ESTANDAR PARA TODAS LAS PÁGINAS (responsive[dos versiones: escritorio y movil])
			-[ ]: [/index.php] PÁGINA DE INICIO QUE DÉ INFORMACIÓN SOBRE EL JUEGO Y TENGA UN LINK A LA WEB DE LA ESCUELA Y OTRO A LA WEB QUE TE REDIRIGE A LA WEB DONDE PUEDES OBTENER EL LECTOR QR
			-[ ]: [ranking/index.php] INTERFAZ DEL RANKING (posicion/nombre de usuario/puntos)
			-[ ]: [/register/#codigo] CREAR PANTALLA QUE MUESTRE "USUARIO nombre REGISTRADO EN EL JUEGO"
			-[ ]: [/admin/index.php] CREA UN PANEL DE ADMINISTRACIÓN
			-[ ]: [/user/index.php] MUESTRA INFORMACIÓN SOBRE EL USUARIO Y SU PUNTUACIÓN
			-[ ]: [/shoot/index.php] MUESTRA INFORMACIÓN SOBRE UN DISPARO REALIZADO [HAS GANADO x PUNTOS/YA HABÍAS DISPARADO AQUÍ]
