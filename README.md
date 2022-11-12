El endpoint de la API es: http://localhost/WEB2/TPE%20Parte%202/

Obtener por ID: http://localhost/WEB2/TPE%20Parte%202/api/prints/id por ejemplo: http://localhost/WEB2/TPE%20Parte%202/api/prints/2

Ordenar por precio ascendiente: http://localhost/WEB2/TPE%20Parte%202/api/prints?sort=precio&order=ASC

Ordenar por precio descendiente: http://localhost/WEB2/TPE%20Parte%202/api/prints?sort=precio&order=DESC

Para agregar un objeto a imprimir: http://localhost/WEB2/TPE%20Parte%202/api/prints/
 y el siguiente código
{
    "nombre": "colocar nombre",
    "descripcion": "colocar descripcion",
    "tipo_id_fk": id de la categoría,
    "dimensiones": "numeros separados por x",
    "precio": precio en número entero
}

Obtener cualquier columna paginada y ordenada: http://localhost/WEB2/TPE%20Parte%202/api/prints?sort=precio&order=asc&begin=0&end=3 (Acá se ordena por precio)

Obtener cualquier columna de la tabla: http://localhost/WEB2/TPE%20Parte%202/api/prints?select=[Nombre de columna, por ejemplo, nombre]

Obtener cualquier columna de la tabla ordenada (ascendente o descendente): http://localhost/WEB2/TPE%20Parte%202/api/prints?sort=id&order=desc

Obtener cualquier columna paginada: http://localhost/WEB2/TPE%20Parte%202/api/prints?begin=2&end=5