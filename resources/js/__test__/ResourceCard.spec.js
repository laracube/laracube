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
                line1: {
                    value: 100,
                },
                line2: {
                    value: 'from 50',
                },
                trend: {
                    value: 20,
                    icon: 'fa-arrow-up',
                },
                sparkline: {
                    value: [1, 2, 3, 4, 5, 6],
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
                component: 'big-number',
                heading: 'Heading',
                subHeading: 'Sub Heading',
                type: null,
                uriKey: 'big-number',
            },
        },
        mocks: {
            $axios: axios,
        },
    });
}

describe('BigNumber', () => {
    it('should load the components', () => {
        const wrapper = factory();
        expect(wrapper.find('.v-card').vm).toBeTruthy();
    });

    it('should show the heading and sub-heading', () => {
        const wrapper = factory();
        expect(wrapper.find('.v-card__title').html()).toContain('Heading');
        expect(wrapper.find('.v-card__subtitle').html()).toContain('Sub Heading');
    });

    it('should show the correct data from api response for line 1', async () => {
        const wrapper = factory();
        await flushPromises();
        expect(wrapper.html()).toMatchSnapshot();
        expect(wrapper.find('.line1').html()).toContain(100);
    });

    it('should show the correct data from api response for line 2', async () => {
        const wrapper = factory();
        await flushPromises();
        expect(wrapper.find('.line2').html()).toContain('from 50');
    });

    it('should show the correct data from api response for trend', async () => {
        const wrapper = factory();
        await flushPromises();
        expect(wrapper.find('.trend').html()).toContain('20');
    });
});
