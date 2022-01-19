<!doctype html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, user-scalable=no, initial-scale=1.0">
    <title>Confirmacion del correo</title>
</head>
<body>
    <h1>ePayco - Soap</h1>
    <p>Hola! Se ha reportado una compra de: <strong>{{ $pago->description }}</strong> por un valor de <strong>{{ $pago->value }}</strong>.</p>
    <p>Para confirmar la misma por favor el siguente codigo:</p>
    <h2>{{ $pago->code }}</h2>
    <P>Muchas gracias por su atencion - ePayco Soap</P>
</body>
</html>
