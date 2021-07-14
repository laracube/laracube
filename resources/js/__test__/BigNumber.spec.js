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
                number: '100',
            },
        }),
}));

function factory() {
    return mount(RenderResource, {
        localVue,
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
        expect(wrapper.find('.v-card__subtitle').html()).toContain(
            'Sub Heading',
        );
    });

    it('should show the correct number from api response', async () => {
        const wrapper = factory();
        await flushPromises();
        expect(wrapper.find('.v-card__text>.text-h2').html()).toContain(100);
    });
});
