<?php

/*
|--------------------------------------------------------------------------
| Load The Cached Routes
|--------------------------------------------------------------------------
|
| Here we will decode and unserialize the RouteCollection instance that
| holds all of the route information for an application. This allows
| us to instantaneously load the entire route map into the router.
|
*/

app('router')->setCompiledRoutes(
    array (
  'compiled' => 
  array (
    0 => false,
    1 => 
    array (
      '/laravel-websockets' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::nWEmB2y5eoXO5F71',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/laravel-websockets/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::ed80voZY0NdNnIRD',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/laravel-websockets/event' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::NID2z8ZKwIQnVZU3',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/laravel-websockets/statistics' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::O6bTktkB59uiGaMR',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/sanctum/csrf-cookie' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'sanctum.csrf-cookie',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/health-check' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.healthCheck',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/execute-solution' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.executeSolution',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/_ignition/update-config' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'ignition.updateConfig',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/broadcasting/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::2jxudsF00DizzWk8',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/login' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::WelGxTfLHzUvsnXj',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/register' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JYquwIG5lmuzzsku',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/verificar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::coc8vOe94tR2ltXk',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/reenviar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::4SFaKQSuNeq9VgIS',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/userinfo' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::0YOorFxWzQDpoYcK',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/desabilitar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VOZooThfO22kotEK',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/activar' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::vTSQo9MgWhJlPtCF',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/Habitacion' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7q8PV4MB00WDo79i',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::dCpFhqpyJQ0bacoA',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/Empleados' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IdRONNq1rYtOBRJf',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/Empleado' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::043i0W3aUyUUXqlc',
          ),
          1 => NULL,
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/auditoria' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::JgCs0mWtvkkeUPes',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/auditoria/estadisticas/usuarios' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::BMnYTTvHbuaR5WXO',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/broadcasting/auth' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::VpnZNkwtluLCi1cX',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'POST' => 1,
            'HEAD' => 2,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/api/v1/Facturas/SSE' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::GtQ95PcCHilfe2iV',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      '/' => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OqNbDKWhpbaey5rh',
          ),
          1 => NULL,
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
    ),
    2 => 
    array (
      0 => '{^(?|/laravel\\-websockets/api/([^/]++)/statistics(*:51)|/api/v1/(?|users(?|(?:/([^/]++))?(*:91)|/([^/]++)(*:107))|cambiarrol/([^/]++)(*:135)|quitarrol/([^/]++)(*:161)|Reservacion(?|(?:/([^/]++))?(*:197)|/(?|usuario(*:216)|([^/]++)(?|(*:235))|cancelar/([^/]++)(*:261))|(*:270))|Factura(?|(?:/([^/]++))?(*:303)|(*:311)|/([^/]++)(?|(*:331)))|H(?|abitacion/([^/]++)(?|(*:366))|uesped(?|(?:/([^/]++))?(*:398)|/(?|actual(*:416)|([^/]++)(?|(*:435)))|(*:445)))|Mantenimiento(?|(?:/([^/]++))?(*:485)|(*:493)|/([^/]++)(?|(*:513)))|Empleado/([^/]++)(?|(*:543))))/?$}sDu',
    ),
    3 => 
    array (
      51 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::OG6oF4lswdUGE3Mb',
          ),
          1 => 
          array (
            0 => 'appId',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      91 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::65getDNRlgHL5Zhz',
            'id' => NULL,
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      107 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::RE0weHRx9wzXO3j6',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      135 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::xYPKXLgez8v8xmsk',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      161 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::XO7ddcbyf9XVvaMv',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      197 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::1jt0fTf27VZ7Rk6Q',
            'id' => NULL,
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      216 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::bVvtNG3j3hElKceP',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      235 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::L5tyzcsmQsp33D68',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::aXr3AqWbabbLMDm5',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      261 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::FdrObt8uAKun2rux',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      270 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::jUe5rUTcOJ9wafoR',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      303 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::pAG7xuyVTqnvvYuG',
            'id' => NULL,
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      311 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::oXSBoFKwWelLk4WG',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      331 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::5K9CB1ebAxbD13rr',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Ziw0lK2hB5c1ww4B',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      366 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::rnRcP3zMODQOvJQO',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::O0jvyJ6zsy8AfROf',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      398 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::Z6Qko5Oj8Y7Ffj1u',
            'id' => NULL,
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      416 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7nddpDUkJfGxmy0K',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      435 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::7aMfbbIckuVW3a3D',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::p8UPWWZanrg2Sqkt',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      445 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::IOmT9gJiStnF9jAY',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      485 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::SsjLAsLZaIE3geTr',
            'id' => NULL,
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'GET' => 0,
            'HEAD' => 1,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      493 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::q5orePTqnpyO4LDm',
          ),
          1 => 
          array (
          ),
          2 => 
          array (
            'POST' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => false,
          6 => NULL,
        ),
      ),
      513 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::C1smGvIj6H2Z6CIj',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::MYfAhwIYhUhRzrcs',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
      ),
      543 => 
      array (
        0 => 
        array (
          0 => 
          array (
            '_route' => 'generated::b5IYCbl28O6Kxv0A',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'PUT' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        1 => 
        array (
          0 => 
          array (
            '_route' => 'generated::G49iQvmYnBqnDUBT',
          ),
          1 => 
          array (
            0 => 'id',
          ),
          2 => 
          array (
            'DELETE' => 0,
          ),
          3 => NULL,
          4 => false,
          5 => true,
          6 => NULL,
        ),
        2 => 
        array (
          0 => NULL,
          1 => NULL,
          2 => NULL,
          3 => NULL,
          4 => false,
          5 => false,
          6 => 0,
        ),
      ),
    ),
    4 => NULL,
  ),
  'attributes' => 
  array (
    'generated::nWEmB2y5eoXO5F71' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'laravel-websockets',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Middleware\\Authorize',
        ),
        'uses' => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Controllers\\ShowDashboard@__invoke',
        'controller' => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Controllers\\ShowDashboard',
        'namespace' => NULL,
        'prefix' => 'laravel-websockets',
        'where' => 
        array (
        ),
        'as' => 'generated::nWEmB2y5eoXO5F71',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OG6oF4lswdUGE3Mb' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'laravel-websockets/api/{appId}/statistics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Middleware\\Authorize',
        ),
        'uses' => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Controllers\\DashboardApiController@getStatistics',
        'controller' => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Controllers\\DashboardApiController@getStatistics',
        'namespace' => NULL,
        'prefix' => 'laravel-websockets',
        'where' => 
        array (
        ),
        'as' => 'generated::OG6oF4lswdUGE3Mb',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::ed80voZY0NdNnIRD' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'laravel-websockets/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Middleware\\Authorize',
        ),
        'uses' => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Controllers\\AuthenticateDashboard@__invoke',
        'controller' => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Controllers\\AuthenticateDashboard',
        'namespace' => NULL,
        'prefix' => 'laravel-websockets',
        'where' => 
        array (
        ),
        'as' => 'generated::ed80voZY0NdNnIRD',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::NID2z8ZKwIQnVZU3' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'laravel-websockets/event',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
          1 => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Middleware\\Authorize',
        ),
        'uses' => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Controllers\\SendMessage@__invoke',
        'controller' => 'BeyondCode\\LaravelWebSockets\\Dashboard\\Http\\Controllers\\SendMessage',
        'namespace' => NULL,
        'prefix' => 'laravel-websockets',
        'where' => 
        array (
        ),
        'as' => 'generated::NID2z8ZKwIQnVZU3',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::O6bTktkB59uiGaMR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'laravel-websockets/statistics',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'BeyondCode\\LaravelWebSockets\\Statistics\\Http\\Middleware\\Authorize',
        ),
        'uses' => 'BeyondCode\\LaravelWebSockets\\Statistics\\Http\\Controllers\\WebSocketStatisticsEntriesController@store',
        'controller' => 'BeyondCode\\LaravelWebSockets\\Statistics\\Http\\Controllers\\WebSocketStatisticsEntriesController@store',
        'namespace' => NULL,
        'prefix' => 'laravel-websockets',
        'where' => 
        array (
        ),
        'as' => 'generated::O6bTktkB59uiGaMR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'sanctum.csrf-cookie' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'sanctum/csrf-cookie',
      'action' => 
      array (
        'uses' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'controller' => 'Laravel\\Sanctum\\Http\\Controllers\\CsrfCookieController@show',
        'namespace' => NULL,
        'prefix' => 'sanctum',
        'where' => 
        array (
        ),
        'middleware' => 
        array (
          0 => 'web',
        ),
        'as' => 'sanctum.csrf-cookie',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.healthCheck' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '_ignition/health-check',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\HealthCheckController',
        'as' => 'ignition.healthCheck',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.executeSolution' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/execute-solution',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\ExecuteSolutionController',
        'as' => 'ignition.executeSolution',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'ignition.updateConfig' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => '_ignition/update-config',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'Spatie\\LaravelIgnition\\Http\\Middleware\\RunnableSolutionsEnabled',
        ),
        'uses' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController@__invoke',
        'controller' => 'Spatie\\LaravelIgnition\\Http\\Controllers\\UpdateConfigController',
        'as' => 'ignition.updateConfig',
        'namespace' => NULL,
        'prefix' => '_ignition',
        'where' => 
        array (
        ),
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::2jxudsF00DizzWk8' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'broadcasting/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'auth:api',
        ),
        'uses' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'controller' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
          0 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
        ),
        'as' => 'generated::2jxudsF00DizzWk8',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::WelGxTfLHzUvsnXj' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/login',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@login',
        'controller' => 'App\\Http\\Controllers\\UserController@login',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::WelGxTfLHzUvsnXj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JYquwIG5lmuzzsku' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/register',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@register',
        'controller' => 'App\\Http\\Controllers\\UserController@register',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::JYquwIG5lmuzzsku',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::coc8vOe94tR2ltXk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/verificar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@verifyEmail',
        'controller' => 'App\\Http\\Controllers\\UserController@verifyEmail',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::coc8vOe94tR2ltXk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::4SFaKQSuNeq9VgIS' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/reenviar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@renviarcodigo',
        'controller' => 'App\\Http\\Controllers\\UserController@renviarcodigo',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::4SFaKQSuNeq9VgIS',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::0YOorFxWzQDpoYcK' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/userinfo',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@VerificarCuenta',
        'controller' => 'App\\Http\\Controllers\\UserController@VerificarCuenta',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::0YOorFxWzQDpoYcK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::65getDNRlgHL5Zhz' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/users/{id?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'auditoria.consulta',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@mostrarUsuarios',
        'controller' => 'App\\Http\\Controllers\\UserController@mostrarUsuarios',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::65getDNRlgHL5Zhz',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VOZooThfO22kotEK' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/desabilitar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@desabilitarUsuario',
        'controller' => 'App\\Http\\Controllers\\UserController@desabilitarUsuario',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::VOZooThfO22kotEK',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::vTSQo9MgWhJlPtCF' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/activar',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@activar_usuario',
        'controller' => 'App\\Http\\Controllers\\UserController@activar_usuario',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::vTSQo9MgWhJlPtCF',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::xYPKXLgez8v8xmsk' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/cambiarrol/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@darroluser',
        'controller' => 'App\\Http\\Controllers\\UserController@darroluser',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::xYPKXLgez8v8xmsk',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::XO7ddcbyf9XVvaMv' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/quitarrol/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@cambiarroluser',
        'controller' => 'App\\Http\\Controllers\\UserController@cambiarroluser',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::XO7ddcbyf9XVvaMv',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::RE0weHRx9wzXO3j6' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/users/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\UserController@actualizarUser',
        'controller' => 'App\\Http\\Controllers\\UserController@actualizarUser',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::RE0weHRx9wzXO3j6',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::1jt0fTf27VZ7Rk6Q' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/Reservacion/{id?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'auditoria.consulta',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservacionesController@mostrarReservacion',
        'controller' => 'App\\Http\\Controllers\\ReservacionesController@mostrarReservacion',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::1jt0fTf27VZ7Rk6Q',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::bVvtNG3j3hElKceP' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/Reservacion/usuario',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'auditoria.consulta',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservacionesController@reservacionUsuario',
        'controller' => 'App\\Http\\Controllers\\ReservacionesController@reservacionUsuario',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::bVvtNG3j3hElKceP',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::jUe5rUTcOJ9wafoR' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/Reservacion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservacionesController@nuevaReservacion',
        'controller' => 'App\\Http\\Controllers\\ReservacionesController@nuevaReservacion',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::jUe5rUTcOJ9wafoR',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::L5tyzcsmQsp33D68' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/Reservacion/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservacionesController@actualizarReservacion',
        'controller' => 'App\\Http\\Controllers\\ReservacionesController@actualizarReservacion',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::L5tyzcsmQsp33D68',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::aXr3AqWbabbLMDm5' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/Reservacion/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservacionesController@eliminarReservacion',
        'controller' => 'App\\Http\\Controllers\\ReservacionesController@eliminarReservacion',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::aXr3AqWbabbLMDm5',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::FdrObt8uAKun2rux' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/Reservacion/cancelar/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\ReservacionesController@cancelarReservacion',
        'controller' => 'App\\Http\\Controllers\\ReservacionesController@cancelarReservacion',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::FdrObt8uAKun2rux',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::pAG7xuyVTqnvvYuG' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/Factura/{id?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'auditoria.consulta',
        ),
        'uses' => 'App\\Http\\Controllers\\FacturasController@mostrarFacturas',
        'controller' => 'App\\Http\\Controllers\\FacturasController@mostrarFacturas',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::pAG7xuyVTqnvvYuG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::oXSBoFKwWelLk4WG' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/Factura',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\FacturasController@nuevaFactura',
        'controller' => 'App\\Http\\Controllers\\FacturasController@nuevaFactura',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::oXSBoFKwWelLk4WG',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::5K9CB1ebAxbD13rr' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/Factura/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\FacturasController@actualizarFactura',
        'controller' => 'App\\Http\\Controllers\\FacturasController@actualizarFactura',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::5K9CB1ebAxbD13rr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Ziw0lK2hB5c1ww4B' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/Factura/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\FacturasController@eliminarFactura',
        'controller' => 'App\\Http\\Controllers\\FacturasController@eliminarFactura',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Ziw0lK2hB5c1ww4B',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7q8PV4MB00WDo79i' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/Habitacion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'auditoria.consulta',
        ),
        'uses' => 'App\\Http\\Controllers\\HabitacionController@mostrarHabitaciones',
        'controller' => 'App\\Http\\Controllers\\HabitacionController@mostrarHabitaciones',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7q8PV4MB00WDo79i',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::dCpFhqpyJQ0bacoA' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/Habitacion',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\HabitacionController@nuevaHabitacion',
        'controller' => 'App\\Http\\Controllers\\HabitacionController@nuevaHabitacion',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::dCpFhqpyJQ0bacoA',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::rnRcP3zMODQOvJQO' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/Habitacion/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\HabitacionController@actualizarHabitacion',
        'controller' => 'App\\Http\\Controllers\\HabitacionController@actualizarHabitacion',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::rnRcP3zMODQOvJQO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::O0jvyJ6zsy8AfROf' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/Habitacion/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\HabitacionController@eliminarHabitacion',
        'controller' => 'App\\Http\\Controllers\\HabitacionController@eliminarHabitacion',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::O0jvyJ6zsy8AfROf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::Z6Qko5Oj8Y7Ffj1u' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/Huesped/{id?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'auditoria.consulta',
        ),
        'uses' => 'App\\Http\\Controllers\\HuespedController@mostrarHuespedes',
        'controller' => 'App\\Http\\Controllers\\HuespedController@mostrarHuespedes',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::Z6Qko5Oj8Y7Ffj1u',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7nddpDUkJfGxmy0K' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/Huesped/actual',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'auditoria.consulta',
        ),
        'uses' => 'App\\Http\\Controllers\\HuespedController@getHuespedActual',
        'controller' => 'App\\Http\\Controllers\\HuespedController@getHuespedActual',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7nddpDUkJfGxmy0K',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IOmT9gJiStnF9jAY' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/Huesped',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\HuespedController@nuevoHuesped',
        'controller' => 'App\\Http\\Controllers\\HuespedController@nuevoHuesped',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::IOmT9gJiStnF9jAY',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::7aMfbbIckuVW3a3D' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/Huesped/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\HuespedController@actualizarHuesped',
        'controller' => 'App\\Http\\Controllers\\HuespedController@actualizarHuesped',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::7aMfbbIckuVW3a3D',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::p8UPWWZanrg2Sqkt' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/Huesped/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\HuespedController@eliminarHuesped',
        'controller' => 'App\\Http\\Controllers\\HuespedController@eliminarHuesped',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::p8UPWWZanrg2Sqkt',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::SsjLAsLZaIE3geTr' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/Mantenimiento/{id?}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'auditoria.consulta',
        ),
        'uses' => 'App\\Http\\Controllers\\MantenimientoController@mostrarMantenimientos',
        'controller' => 'App\\Http\\Controllers\\MantenimientoController@mostrarMantenimientos',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::SsjLAsLZaIE3geTr',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::q5orePTqnpyO4LDm' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/Mantenimiento',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\MantenimientoController@nuevoMantenimiento',
        'controller' => 'App\\Http\\Controllers\\MantenimientoController@nuevoMantenimiento',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::q5orePTqnpyO4LDm',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::C1smGvIj6H2Z6CIj' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/Mantenimiento/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\MantenimientoController@actualizarMantenimiento',
        'controller' => 'App\\Http\\Controllers\\MantenimientoController@actualizarMantenimiento',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::C1smGvIj6H2Z6CIj',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::MYfAhwIYhUhRzrcs' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/Mantenimiento/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\MantenimientoController@eliminarMantenimiento',
        'controller' => 'App\\Http\\Controllers\\MantenimientoController@eliminarMantenimiento',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::MYfAhwIYhUhRzrcs',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::IdRONNq1rYtOBRJf' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/Empleados',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'auditoria.consulta',
        ),
        'uses' => 'App\\Http\\Controllers\\EmpleadoController@mostrarEmpleados',
        'controller' => 'App\\Http\\Controllers\\EmpleadoController@mostrarEmpleados',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::IdRONNq1rYtOBRJf',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::043i0W3aUyUUXqlc' => 
    array (
      'methods' => 
      array (
        0 => 'POST',
      ),
      'uri' => 'api/v1/Empleado',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\EmpleadoController@nuevoEmpleado',
        'controller' => 'App\\Http\\Controllers\\EmpleadoController@nuevoEmpleado',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::043i0W3aUyUUXqlc',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::b5IYCbl28O6Kxv0A' => 
    array (
      'methods' => 
      array (
        0 => 'PUT',
      ),
      'uri' => 'api/v1/Empleado/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\EmpleadoController@actualizarEmpleado',
        'controller' => 'App\\Http\\Controllers\\EmpleadoController@actualizarEmpleado',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::b5IYCbl28O6Kxv0A',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::G49iQvmYnBqnDUBT' => 
    array (
      'methods' => 
      array (
        0 => 'DELETE',
      ),
      'uri' => 'api/v1/Empleado/{id}',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
          3 => 'rol:2',
        ),
        'uses' => 'App\\Http\\Controllers\\EmpleadoController@eliminarEmpleado',
        'controller' => 'App\\Http\\Controllers\\EmpleadoController@eliminarEmpleado',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::G49iQvmYnBqnDUBT',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::JgCs0mWtvkkeUPes' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/auditoria',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\AuditoriaController@index',
        'controller' => 'App\\Http\\Controllers\\AuditoriaController@index',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::JgCs0mWtvkkeUPes',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::BMnYTTvHbuaR5WXO' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/auditoria/estadisticas/usuarios',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
        ),
        'uses' => 'App\\Http\\Controllers\\AuditoriaController@estadisticasPorUsuario',
        'controller' => 'App\\Http\\Controllers\\AuditoriaController@estadisticasPorUsuario',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::BMnYTTvHbuaR5WXO',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::VpnZNkwtluLCi1cX' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'POST',
        2 => 'HEAD',
      ),
      'uri' => 'api/broadcasting/auth',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
          1 => 'auth.jwt',
          2 => 'JwtMiddleware',
        ),
        'uses' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'controller' => '\\Illuminate\\Broadcasting\\BroadcastController@authenticate',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'excluded_middleware' => 
        array (
          0 => 'Illuminate\\Foundation\\Http\\Middleware\\VerifyCsrfToken',
        ),
        'as' => 'generated::VpnZNkwtluLCi1cX',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::GtQ95PcCHilfe2iV' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => 'api/v1/Facturas/SSE',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'api',
        ),
        'uses' => 'App\\Http\\Controllers\\FacturasController@facturaStream',
        'controller' => 'App\\Http\\Controllers\\FacturasController@facturaStream',
        'namespace' => NULL,
        'prefix' => 'api',
        'where' => 
        array (
        ),
        'as' => 'generated::GtQ95PcCHilfe2iV',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
    'generated::OqNbDKWhpbaey5rh' => 
    array (
      'methods' => 
      array (
        0 => 'GET',
        1 => 'HEAD',
      ),
      'uri' => '/',
      'action' => 
      array (
        'middleware' => 
        array (
          0 => 'web',
        ),
        'uses' => 'O:47:"Laravel\\SerializableClosure\\SerializableClosure":1:{s:12:"serializable";O:46:"Laravel\\SerializableClosure\\Serializers\\Signed":2:{s:12:"serializable";s:264:"O:46:"Laravel\\SerializableClosure\\Serializers\\Native":5:{s:3:"use";a:0:{}s:8:"function";s:46:"function () {
    return \\view(\'welcome\');
}";s:5:"scope";s:37:"Illuminate\\Routing\\RouteFileRegistrar";s:4:"this";N;s:4:"self";s:32:"00000000000006660000000000000000";}";s:4:"hash";s:44:"snfgYjSdRBXnaZE38dqzx6sSAbyeXAgQ95xp/ytA1e8=";}}',
        'namespace' => NULL,
        'prefix' => '',
        'where' => 
        array (
        ),
        'as' => 'generated::OqNbDKWhpbaey5rh',
      ),
      'fallback' => false,
      'defaults' => 
      array (
      ),
      'wheres' => 
      array (
      ),
      'bindingFields' => 
      array (
      ),
      'lockSeconds' => NULL,
      'waitSeconds' => NULL,
      'withTrashed' => false,
    ),
  ),
)
);
