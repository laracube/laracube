import Vue from 'vue';
// specify components used in blade
import Vuetify, {
    VApp,
    VAppBar,
    VNavigationDrawer,
    VMain,
    VContainer,
    VRow,
    VCol,
    VCard,
    VImg,
    VList,
    VListItem,
    VListItemAvatar,
    VListItemContent,
    VListItemTitle,
    VFooter,
    VSubheader,
    VListItemGroup,
    VDivider,
    VAppBarNavIcon,
} from 'vuetify/lib';

Vue.use(Vuetify, {
    components: {
        VApp,
        VAppBar,
        VNavigationDrawer,
        VMain,
        VContainer,
        VRow,
        VCol,
        VCard,
        VImg,
        VList,
        VListItem,
        VListItemAvatar,
        VListItemContent,
        VListItemTitle,
        VFooter,
        VSubheader,
        VListItemGroup,
        VDivider,
        VAppBarNavIcon,
    },
});

const opts = {
    theme: {
        themes: {
            light: {
                primary: '#FF0000',
            },
        },
    },
};

export default new Vuetify(opts);
