# Estudo preliminar

## 1. Descrición do proxecto
Trátase dunha aplicación web de xestión orientada a empresas dedicadas á recollida de residuos, principalmente aceites usados, e aos talleres que xeran este tipo de residuos. A aplicación permite organizar e controlar todo o proceso de recollida, dende a creación de rutas por parte dos xestores ata o seguimento das mesmas polos condutores.

O obxectivo principal é facilitar e dixitalizar a xestión deste tipo de servizo, permitindo tamén a xeración da documentación necesaria para cumprir coa normativa vixente.


### 1.1. Xustificación do proxecto
A idea naceu tras detectar que moitas empresas de recollida de residuos aínda xestionan as súas operacións mediante métodos pouco eficientes (papel, chamadas telefónicas, follas de cálculo...), o que complica o control das rutas, o seguimento en tempo real e a xeración de documentación obrigatoria.

Este proxecto pretende resolver ese problema ofrecendo unha solución centralizada, accesible e fácil de usar, que mellore a eficiencia operativa e reduza erros humanos, ademais de facilitar o cumprimento legal.

### 1.2. Funcionalidades do proxecto
As principais funcionalidades da aplicación serán:

- Creación e xestión de rutas de recollida por parte dos xestores.
- Consulta e actualización das rutas asignadas polos condutores en tempo real.
- Rexistro dos residuos recollidos en cada parada.
- Xestión de talleres e puntos de recollida.
- Xeración automática de documentación para clientes e permisos de transporte.
- Panel de administración con estatísticas básicas e histórico de rutas.


### 1.3. Estudo de necesidades
Existen aplicacións como Teixo, EcoGestor, ResiduosApp ou sistemas ERP específicos para empresas de xestión ambiental, pero moitas delas son solucións xerais, complexas ou de difícil adaptación a pequenas e medianas empresas. Esta aplicación está deseñada especificamente para cubrir as necesidades de empresas que traballan coa recollida de residuos líquidos como o aceite, cun enfoque máis práctico, económico e fácil de implementar.

Ademais, ao estar desenvolta en Laravel con Livewire, facilita unha experiencia de usuario moderna e rápida, ideal para o uso diario en dispositivos móbiles.

### 1.4. Persoas destinatarias
A aplicación vai dirixida a:

- Empresas pequenas e medianas dedicadas á recollida de residuos, especialmente aceites usados.
- Talleres mecánicos que deben entregar os seus residuos a empresas autorizadas.
- Condutores ou persoal que realiza as recollidas, que usarán a app para seguir as rutas asignadas.

O público obxectivo inclúe tanto empresas como grupos profesionais (xestores, condutores e responsables de talleres).

### 1.5. Modelo de negocio
A aplicación empregará un modelo de negocio mixto, que combina un pago inicial coa contratación de licenzas adicionais segundo o número de empregados que necesiten acceso.

Pago inicial único: Inclúe a configuración da conta da empresa, formación básica para o seu uso, e o acceso para un número reducido de usuarios (por exemplo, 1 xestor e 1 condutor).

Licenzas adicionais: A partir dese paquete base, a empresa poderá contratar licenzas extra para cada novo empregado que precise acceso á plataforma (xestores adicionais, condutores, persoal administrativo, etc.).

Este modelo permite garantir unha entrada mínima de ingresos e ao mesmo tempo adapta o custo da aplicación ao tamaño e ás necesidades reais da empresa. Resulta especialmente axeitado para un público obxectivo profesional, que valora unha solución áxil, legalmente conforme e que se poida ir adaptando segundo a evolución do negocio.

## 2. Requirimentos
Para o desenvolvemento do proxecto empregarase:

- Linguaxe de programación: PHP
- Framework: Laravel
- Componentes interactivos: Livewire, JavaScript
- Base de datos: MySQL ou PostgreSQL
- Frontend: Blade (Laravel), con soporte para Tailwind CSS
- Servizos adicionais:
- Autenticación mediante Laravel Breeze ou Jetstream.
- Xeración de documentos en PDF mediante librerías como DomPDF ou SnappyPDF.
- API REST para posibles integracións futuras con aplicacións externas.
- Entorno de desenvolvemento: Docker, Windows, Git, PhpStorm.

Decidin o uso de estas tecnoloxías sobretodo por salida laboral, xa que contactei con varias empresas e en todas buscan un programador para Php e Laravel. Usarei este proxecto como parte do meu portfolio para contactar de novo nuns meses con estas empresas.



