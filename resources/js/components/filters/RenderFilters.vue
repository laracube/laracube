<template>
    <div>
        <div v-if="Array.isArray(filters) && filters.length">
            <v-container class="fill-height">
                <v-row align="center" justify="center">
                    <v-btn
                        color="pink"
                        dark
                        @click.stop="filterDrawer = !filterDrawer"
                    >
                        Toggle
                    </v-btn>
                </v-row>
            </v-container>
            <v-navigation-drawer
                absolute
                clipped
                temporary
                right
                width="450"
                class="top-64"
                v-model="filterDrawer"
            >
                <v-list-item>
                    <v-list-item-avatar>
                        <v-img
                            src="https://randomuser.me/api/portraits/men/78.jpg"
                        ></v-img>
                    </v-list-item-avatar>

                    <v-list-item-content>
                        <v-list-item-title>John Leider</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>

                <v-divider></v-divider>

                <v-list dense>
                    <v-list-item v-for="item in items" :key="item.title" link>
                        <v-list-item-icon>
                            <v-icon>{{ item.icon }}</v-icon>
                        </v-list-item-icon>

                        <v-list-item-content>
                            <v-list-item-title>{{
                                item.title
                            }}</v-list-item-title>
                        </v-list-item-content>
                    </v-list-item>
                </v-list>
            </v-navigation-drawer>
        </div>
    </div>
</template>

<script>
export default {
    name: 'RenderFilters',
    props: {
        filters: { required: true },
    },
    data() {
        return {
            filterDrawer: null,
            items: [
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'Home', icon: 'mdi-view-dashboard' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
                { title: 'About', icon: 'mdi-forum' },
            ],
        };
    },
};
</script>

<style scoped></style>
