import { createLocalVue, mount } from '@vue/test-utils';
import Vue from 'vue';
import Vuex from 'vuex';
import Vuetify from 'vuetify';
import RenderResource from '@/components/resources/RenderResource';
import flushPromises from 'flush-promises';
import axios from 'axios';
import filters from '@/store/modules/filters';

Vue.use(Vuetify);
const localVue = createLocalVue();
localVue.use(Vuex);

jest.mock('axios', () => ({
    post: () =>
        Promise.resolve({
            data: {
                data: [{ name: 'Marvin' }, { name: 'Jasper' }],
                meta: {
                    last_page: 5,
                    from: 1,
                    to: 3,
                    total: 20,
                    columns: [
                        {
                            sortable: false,
                            text: 'Name',
                            tooltip: null,
                            value: 'name',
                        },
                    ],
                },
            },
        }),
}));

function factory() {
    let vuetify = new Vuetify();
    let store = new Vuex.Store({
        modules: {
            filters: {
                state: filters.state,
                mutations: filters.mutations,
                namespaced: true,
            },
        },
    });

    return mount(RenderResource, {
        store,
        localVue,
        vuetify,
        propsData: {
            resource: {
                columns: 4,
                component: 'table',
                heading: 'Heading',
                subHeading: 'Sub Heading',
                type: 'paginated',
                uriKey: 'paginated-table',
            },
            report: {
                meta: {
                    uriKey: 'net-revenue-report',
                },
            },
        },
        mocks: {
            $axios: axios,
        },
    });
}

describe('TablePaginated', () => {
    it('should load the components', () => {
        const wrapper = factory();
        expect(wrapper.find('.v-card').vm).toBeTruthy();
    });

    it('should show the heading and sub-heading tooltip', () => {
        const wrapper = factory();
        expect(wrapper.find('.v-card__title').html()).toContain('Heading');
        expect(wrapper.find('.v-tooltip').vm).toBeTruthy();
    });

    it('should show the correct data from api response', async () => {
        const wrapper = factory();
        await flushPromises();
        expect(wrapper.html()).toMatchSnapshot();
        expect(wrapper.find('td').html()).toContain('Marvin');
    });
});
