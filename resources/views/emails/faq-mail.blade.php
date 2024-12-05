<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nuevo FAQ Creado</title>
</head>
<body>
    <h1>Nueva consulta</h1>
    <p><strong>Pregunta:</strong> {{ $faq->question }}</p>
    <p><strong>Respuesta:</strong> {{ $faq->answer ?? 'Sin respuesta aún.' }}</p>
    <p><strong>Creado por:</strong> {{ optional($faq->user)->name ?? 'Anónimo' }}</p> <!-- Cambia a $faq->user si tienes la relación -->
    <p><strong>Empresa:</strong> {{ $faq->company ?? 'Sin respuesta empresa' }}</p>
    <p>¡Visita el panel de administración para más detalles!</p>
</body>
</html>
