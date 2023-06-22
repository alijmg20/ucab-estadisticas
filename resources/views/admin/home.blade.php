<x-admin-layout>
    @section('title', 'Admin UCAB')
    <div class="pt-4">
        <div class="max-w-3xl mx-auto">
            <h1 class="text-3xl font-bold text-center text-gray-800 my-4">Sistema de proyectos para investigadores del
                Centro de Estudios Regionales</h1>
            <img src="{{ asset('img/logos/LogoUCAB.png') }}" alt="Imagen ilustrativa" class="w-1/2 mx-auto my-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="text-gray-700">
                    <p class="text-2xl font-semibold">
                        Bienvenido <i class="fas fa-handshake text-green-500 mr-2"></i>
                    </p>
                    <p class="my-4">
                        Este portal le permitirá administrar sus proyectos de investigación para obtener resultados y
                        gráficos estadísticos, así como compartir la información de manera que sea visible para la
                        comunidad
                        de una forma responsable.
                    </p>

                    <p class="text-2xl font-semibold">
                        Administre sus proyectos <i class="fas fa-project-diagram text-blue-500 mr-2"></i>
                    </p>
                    <p class="my-4">
                        Puede realizar modificaciones en las variables, nombre y estructura de sus proyectos a través de
                        la
                        plataforma con el fin de mejorar la experiencia con sus datos.
                    </p>

                    <p class="text-2xl font-semibold">
                        Obtener análisis <i class="fas fa-chart-line text-yellow-500 mr-2"></i>
                    </p>
                    <p class="my-4">
                        Realice interacciones entre sus variables para generar gráficos y análisis estadísticos que le
                        sirvan en la toma de decisiones.
                    </p>

                    <p class="text-2xl font-semibold">
                        Acceda a sus proyectos <i class="fas fa-folder-open  text-red-500 mr-2"></i>
                    </p>
                    <p class="my-4">
                        Revise fácilmente los proyectos asociados a su perfil de investigador.
                    </p>
                </div>
                <div class="text-gray-700 mb-4 mt-4">
                    <p class="text-lg font-semibold">Ventajas</p>     
                <ul class="list-disc pl-5">
                    <li class="text-lg font-semibold mb-2">
                        <i class="fas fa-chart-line mr-2"></i>Permite obtener gráficos estadísticos con solo cargar un
                        archivo de datos. Esto le permitirá visualizar y analizar sus datos de una forma gráfica y
                        sencilla.
                    </li>

                    <li class="text-lg font-semibold mb-2">
                        <i class="fas fa-share-square mr-2"></i> Se puede compartir de forma fácil los proyectos y
                        resultados con otros investigadores, estudiantes o colaboradores a través de enlaces y vistas
                        públicas.
                    </li>

                    <li class="text-lg font-semibold mb-2">
                        <i class="fas fa-edit mr-2"></i>Puedes editar de manera personal cada una de tus variables para
                        la correcta presentación y etiquetado de los datos. Esto mejorará la lectura y comprensión de
                        los resultados.
                    </li>
                </ul>
                <p class="text-lg font-semibold">Restricciones</p>    
                <ul class="list-disc pl-5">
                    <li class="text-lg font-semibold  text-red-500 mb-2">
                        <i class="fas fa-exclamation-triangle mr-2"></i> Evita tener más de 15 grupos de datos para
                        presentar dentro de un mismo gráfico. Esto puede afectar la calidad y claridad de la
                        visualización.
                    </li>

                    <li class="text-lg font-semibold text-red-500 mb-2">
                        <i class="fas fa-exclamation-triangle mr-2"></i>Antes de cargar tus datos, recuerda realizar el
                        proceso de limpieza (corrección de valores faltantes, datos duplicados, etc) para asegurar la
                        calidad de tus análisis.
                    </li>
                </ul>
                </div>
            </div>
        </div>
    </div>
</x-admin-layout>
