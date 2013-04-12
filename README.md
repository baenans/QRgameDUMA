***JUEGO QR PARA LA JORNADA DE PUERTAS ABIERTAS***



#¿DE QUÉ VA EL JUEGO?

- Explicación general
			
	El juego es sencillo. Te registras en el mostrador de Informática y debes ir consiguiendo puntos para conseguir un premio (una camiseta, por ejemplo). Además, habrá un ranking donde salgan los usuarios con más puntos y tal.

- Puntuaciones

Las puntuaciones serán: 


	- QR EN PERSONA: 75pts
	- QR EN PUESTO: 25pts
	- QR POR TODO EL PABELLÓN: 100pts


	Y hay que obtener un mínimo de 300pts (visitar 12 puestos, encontrar 3 pegatinas escondidas, disparar a 4 personas o cualquier permutación de las anteriores).

- Tecnologías usadas:

	HTML, CSS, PHP, (MySQL/SQLite)?, JS?


#DIRECTORIOS
	
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

#BASES DE DATOS


players -> id [int] user[varchar30] phone[varchar15] twitter[boolean]

	#id: id de usuario autonumérico 
	#user: nick de twitter o nickname 
	#phone: número de teléfono
	#twitter: si el user es un nick de twitter, es true

places -> id[int] name[varchar30]

	#id-> id de lugar autonumérico 
	#name->descripción del lugar

shoots -> user[int] code[varchar32] score[int]

	#user-> id del usuario que ha disparado
	#code-> codigo QR del objeto/persona disparado(a)
	#score-> puntos que ha ganado con el disparo al objeto/persona

codes -> id[int] type[int] code[varchar32]

	#type-> tipo (1=persona, 2=puesto, 3=escondido)
	#id-> id del obtejo al que apunta el QR
	#code-> código dentro del QR

#TODO
		
		INSTALA UN SERVIDOR PARA PROBAR EN TU MÁQUINA LOCAL (http://www.apacºfriends.org/es/xampp.html)
		NO USES la extensión .html, sino .php (AUNQUE TU DOCUMENTO TENGA SÓLO HTML)

		-[x]: BUSCAR LECTORES QR (que funcionen OFFLINE)
					
					- [x]:	iOS: [QRReader](https://itunes.apple.com/us/app/qr-reader-for-iphone/id368494609?mt=8) 
					- [x]:	Android: [QR Droid](https://play.google.com/store/apps/details?id=la.droid.qr&hl=es) 
					- [x]:	Windows Phone: [QR Code Offline](http://www.windowsphone.com/en-us/store/app/qr-code-offline/3a156888-2f6d-4bad-89f9-fc071a820435)
					- [x]:  Blackberry: [QR.arg](http://appworld.blackberry.com/webstore/content/118628/?lang=en&countrycode=ES)

		-[ ]: BUSCAR LIBRERÍA QUE GENERE CÓDIGOS QR


		-[SQL/PHP/JS]

			-[x]: CREAR ESTRUCTURA BASE DE DATOS 
			-[x]: MÉTODOS PARA CONECTAR CON LA BD Y HACER QUERYs 
			-[ ]: CREAR FUNCIONES NECESARIAS PARA LAS SIGUIENTES TAREAS:
				-[x]: CREA UNA FUNCIÓN QUE GENERE UN CÓDIGO ALEATORIO QUE NO EXISTA EN LA TABLA CODES
				-[x]: AÑADIR UN JUGADOR 
				-[x]: AÑADIR UN LUGAR 
				-[x]: OBTENER INFO DE UN JUGADOR 
				-[x]: OBTENER INFO DE UN LUGAR 
				-[x]: OBTENER LA SUMA DE LAS PUNTUACIONES DE LOS DISPARIOS DE UN JUGADOR
				-[x]: OBTENER LA LISTA DE TODOS LOS JUGADORES Y DE TODOS LOS DISPAROS, SUMAR LAS PUNTUACIONES DE TODOS LOS JUGADORES Y ORDENARLAS (Crear ranking)
				-[x]: EFECTUAR DISPARO 

			-[ ]: CREA UNA FUNCIÓN QUE INTRODUZCA DATOS DE PRUEBA (LLAMANDO A LAS FUNCIONES DISEÑADAS ANTERIORMENTE)
			-[x]: CREA UNA FUNCIÓN QUE GENERE UN CÓDIGO QR

			-[x]: [/getReader/index.php] HACER QUE LA PÁGINA REDIRIJA A CADA USUARIO A LA WEB DONDE PUEDE DESCARGAR CADA LECTOR QR (si hay manera de hacer que se abra en su store, guay)
			-[x]: [/ranking/index.php] REPRESENTAR EL RANKING
			-[x]: [/ranking/index.php][JS/HTML] HACER QUE LA PÁGINA SE ACTUALICE CADA x TIEMPO
			-[ ]: [/register/#codigo] GUARDA UNA COOKIE DE 7 HORAS CON EL CÓDIGO DE USUARIO <- problemas


		-[HTML/CSS]
			-[x]: CREAR ESTILO PRINCIPAL 
			-[x]: [/index.php] PÁGINA DE INICIO QUE DÉ INFORMACIÓN SOBRE EL JUEGO Y TENGA UN LINK A LA WEB DE LA ESCUELA Y OTRO A LA WEB QUE TE REDIRIGE A LA WEB DONDE PUEDES OBTENER EL LECTOR QR 
			-[x]: [ranking/index.php] INTERFAZ DEL RANKING (posicion/nombre de usuario/puntos)
			-[ ]: [/register/user/index.php] CREAR PANTALLA QUE MUESTRE DATOS SOBRE EL USUARIO
			-[x]: [/register/index.php] INTERFAZ DE REGISTRO DE USUARIO 
			-[ ]: [/admin/index.php] CREA UN PANEL DE ADMINISTRACIÓN
			-[ ]: [/shoot/index.php] MUESTRA INFORMACIÓN SOBRE UN DISPARO REALIZADO [HAS GANADO x PUNTOS/YA HABÍAS DISPARADO AQUÍ]
