# Análise: Requirimentos do sistema

## Descrición xeral

Desenvolverase unha aplicación web xunto coa respectiva aplicación android destinadas á xestión de servizos de recollida de residuos, especialmente aceites usados, pensada para empresas pequenas e medianas do sector. Permitirá a creación e asignación de rutas de recollida, a súa execución por parte dos condutores, e a xeración da documentación legal correspondente.

O sistema facilitará o control das operacións diarias, reducirá a carga administrativa e mellorará o cumprimento da normativa ambiental.

## Funcionalidades

Funcionalidades clave incluídas nesta primeira versión (MVP), priorizadas para desenvolvemento nun prazo máximo de 1 mes:

| Acción                      | Descrición                                                                                                                                      |
|----------------------------|-------------------------------------------------------------------------------------------------------------------------------------------------|
| Alta de taller             | O xestor engade un novo taller indicando nome, localización e residuos xerados. Entrada: formulario. Saída: taller gardado na base de datos.    |
| Creación de ruta           | O xestor crea unha ruta escollendo os talleres e a data. Entrada: lista de talleres. Saída: ruta dispoñible para o condutor.                   |
| Asignación de ruta         | O xestor asigna a ruta a un condutor. Entrada: selección de usuario e ruta. Saída: ruta visible para o condutor.                               |
| Execución de ruta          | O condutor marca as paradas realizadas e rexistra a recollida. Entrada: residuos recollidos. Saída: actualización da ruta.                     |
| Xeración de documento PDF  | Xeración de xustificante de recollida en formato PDF. Entrada: datos da recollida. Saída: ficheiro PDF descargable.                            |
| Xestión de usuarios        | O administrador engade xestores ou condutores. Entrada: datos do usuario. Saída: conta creada/modificada.                                      |

## Tipos de usuarios

- Administrador da empresa: Acceso completo á xestión da empresa, usuarios e rutas.
- Xestor: Pode crear rutas, xestionar talleres e asignar condutores.
- Condutor: Ve as rutas asignadas, marca as paradas e rexistra os residuos recollidos.

## Normativa

O proxecto cumprirá coa lexislación vixente en materia de protección de datos:

- LOPDPGDD (Lei Orgánica 3/2018)
- Regulamento Xeral de Protección de Datos (GDPR)

Mecanismos implementados para garantir o cumprimento legal:

- Aviso legal e política de privacidade visibles na aplicación.
- Control de acceso por contrasinal, con roles definidos.
- Almacenamento seguro dos datos en servidor cifrado.
- Xestión do consentimento para o tratamento dos datos persoais.

## Planificación (1 mes)

| Fase                                | Duración    |
|-------------------------------------|-------------|
| Análise e deseño                    | 3 días      |
| Backend con Laravel + Livewire      | 10 días     |
| Frontend con Blade + Tailwind       | 7 días      |
| Integración e funcionalidades clave | 5 días      |
| Probas e corrección de erros        | 3 días      |
| Documentación, despregue e entrega  | 2 días      |

## Orzamento (estimado para proxecto en 1 mes)

| Concepto                           | Custos estimados |
|------------------------------------|------------------|
| Desenvolvemento completo (1 mes)   | 2.000 €          |
| Probas e validación                | 300 €            |
| Servidor, dominio e mantemento     | 200 € / ano      |
| Ferramentas de desenvolvemento     | 100 €            |
| **Total estimado**                 | **2.600 – 2.800 €** |

