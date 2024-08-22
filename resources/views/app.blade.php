<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0" />
    
    <title inertia>{{ config('app.name', 'Laravel') }}</title>
    <link rel="manifest" href="/manifest.json" />

    <link rel="icon" href="/favicon.png" type="image/png">

    <base href="/">
    @vite(['resources/js/app.js',"resources/js/Pages/{$page['component']}.svelte"])
    @inertiaHead
  </head>
  <body>
    @inertia
  </body>
</html>