<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link rel="shortcut icon" href="{{ asset('/vendor/laracube/img/favicon.png') }}">
        <link href="https://fonts.googleapis.com/css?family=Poppins:100,300,400,500,700,900" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/@mdi/font@4.x/css/materialdesignicons.min.css" rel="stylesheet">
        <link href="{{ asset(mix('app.css', 'vendor/laracube')) }}" rel="stylesheet">
    </head>
    <body>
        <div id="laracube">
            <v-app>
                <v-app-bar
                    app
                    flat
                    clipped-left
                    color="white"
                    class="shadow z-50"
                >
                    <v-app-bar-nav-icon @click="drawer = !drawer"></v-app-bar-nav-icon>
                    <v-row no-gutters>
                        <v-col>
                            @include('laracube::partials.logo')
                        </v-col>
                        <v-col>
                            @include('laracube::partials.user')
                        </v-col>
                    </v-row>
                </v-app-bar>
                <v-navigation-drawer
                    app
                    floating
                    clipped
                    color="grey lighten-5"
                    v-model="drawer"
                >
                    @include('laracube::partials.navigation')
                </v-navigation-drawer>
                <v-main
                    class="grey lighten-5"
                >
                    <v-container
                        fluid
                        class="pa-8"
                    >
                        <router-view
                            :key="$route.path"
                        ></router-view>
                    </v-container>
                </v-main>
                <v-footer
                    app
                    color="grey lighten-5"
                >
                    @include('laracube::partials.footer')
                </v-footer>
            </v-app>
        </div>
        <!-- Global Laracube Object -->
        <script>
            window.LaracubeConfig = @json($laracubeConfig);
        </script>

        <script src="{{asset(mix('app.js', 'vendor/laracube'))}}"></script>
    </body>
</html>

