<div class="float-right">
    <v-list class="transparent">
        <v-list-item>
            @isset($user->email)
                <v-list-item-avatar size="24">
                    <v-img
                        src="https://secure.gravatar.com/avatar/{{ md5(\Illuminate\Support\Str::lower($user->email)) }}?size=512"
                    ></v-img>
                </v-list-item-avatar>
            @endisset
            <v-list-item-content>
                <v-list-item-title>
                    {{ $user->name ?? $user->email ??  'Laracube User' }}
                </v-list-item-title>
            </v-list-item-content>
        </v-list-item>
    </v-list>
</div>
