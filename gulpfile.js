var elixir = require('laravel-elixir');


elixir(function(mix) {
     mix.sass('app.scss');
     mix.scripts(["app.js"]);
    // mix.styles(['bootstrap-social/bootstrap-social.css', 'bootstrap-social/assets/css/font-awesome.css']);
});

