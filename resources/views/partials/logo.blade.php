<router-link :to="{ name: 'home'}" class="text-decoration-none">
    <v-list class="transparent">
        <v-list-item>
            <v-list-item-avatar size="24">
                <v-img
                    src="{{ asset('vendor/laracube/img/logo.svg') }}"
                ></v-img>
            </v-list-item-avatar>
            <v-list-item-content>
                <v-list-item-title class="font-weight-bold">
                    laracube
                </v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </v-list>
</router-link>
