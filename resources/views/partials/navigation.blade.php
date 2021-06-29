<div class="pt-4">
    <v-list dense nav class="pt-0">
        @foreach($groups as $key => $group)
            <v-subheader class="text--secondary mt-4">{{ $key }}</v-subheader>
            @foreach($group as $report )
                <v-list-item-group>
                    <v-list-item
                        :to="{
                            name: 'report',
                                params: {
                                    uriKey: '{{ $report['meta']['uriKey'] }}'
                                }
                            }"
                        link
                    >
                        <v-list-item-content>
                            <v-list-item-title class="body-2">
                                {{ $report['meta']['navigation'] }}
                            </v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list-item-group>
            @endforeach
        @endforeach
    </v-list>
</div>
