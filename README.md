El endpoint de la API es: http://localhost/WEB2/TPE%20Parte%202/

Obtener por IP: http://localhost/WEB2/TPE%20Parte%202/api/prints/id por ejemplo: http://localhost/WEB2/TPE%20Parte%202/api/prints/2

Ordenar por precio ascendiente: http://localhost/WEB2/TPE%20Parte%202/api/prints?sort=precio&order=ASC

Ordenar por precio descendiente: http://localhost/WEB2/TPE%20Parte%202/api/prints?sort=precio&order=DESC

Para agregar un objeto a imprimir: http://localhost/WEB2/TPE%20Parte%202/api/prints/
 y el siguiente código
{
    "nombre": "colocar nombre",
    "descripcion": "colocar descripcion",
    "tipo_id_fk": id de la categoría,
    "dimensiones": "numeros separados por x",
    "precio": precio en numero entero
}