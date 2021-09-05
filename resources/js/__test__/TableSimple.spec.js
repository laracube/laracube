import { createLocalVue, mount } from '@vue/test-utils';
import Vue from 'vue';
import Vuetify from 'vuetify';
import RenderResource from '@/components/resources/RenderResource';
import flushPromises from 'flush-promises';
import axios from 'axios';

Vue.use(Vuetify);
const localVue = createLocalVue();

jest.mock('axios', () => ({
    get: () =>
        Promise.resolve({
            data: {
                data: [{ name: 'Marvin' }, { name: 'Jasper' }],
                meta: {
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

    return mount(RenderResource, {
        localVue,
        vuetify,
        propsData: {
            resource: {
                columns: 4,
                component: 'table',
                heading: 'Heading',
                subHeading: 'Sub Heading',
                type: 'simple',
                uriKey: 'paginated-table',
            },
        },
        mocks: {
            $axios: axios,
        },
    });
}

describe('TableSimple', () => {
    it('should load the components', () => {
        const wrapper = factory();
        expect(wrapper.find('.v-card').vm).toBeTruthy();
    });

    it('should show the heading and sub-heading', () => {
        const wrapper = factory();
        expect(wrapper.find('.v-card__title').html()).toContain('Heading');
        expect(wrapper.find('.v-card__subtitle').html()).toContain('Sub Heading');
    });

    it('should show the correct data from api response', async () => {
        const wrapper = factory();
        await flushPromises();
        expect(wrapper.html()).toMatchSnapshot();
        expect(wrapper.find('td').html()).toContain('Marvin');
    });
});
