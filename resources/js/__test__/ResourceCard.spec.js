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
            data: [
                {
                    type: 'bigNumber',
                    data: {
                        line1: { value: '100' },
                        line2: { value: 'from 50' },
                        trend: {
                            value: '100%',
                            cssClass: 'green--text text--darken-3',
                            icon: { value: 'fa-arrow-up', cssClass: 'green lighten-5 rounded-circle px-4 py-2' },
                        },
                    },
                },
                {
                    type: 'customHtml',
                    data: {
                        value: 'custom html component',
                    },
                },
                {
                    type: 'sparkline',
                    data: {
                        autoDraw: true,
                        autoDrawDuration: 2000,
                        autoDrawEasing: 'ease',
                        autoLineWidth: false,
                        color: 'grey--text text--darken-1',
                        fill: false,
                        gradient: ['#163AFC', '#6079FF', '#B4BFFF'],
                        gradientDirection: 'top',
                        height: 75,
                        labelSize: 7,
                        labels: ['1570.44', '435.18', '1600.86', '843.92', '1205.06', '1646.98'],
                        lineWidth: 3,
                        padding: 15,
                        showLabels: false,
                        smooth: 10,
                        type: 'trend',
                        value: [1570, 435, 1600, 843, 1205, 1646],
                        width: 300,
                        title: 'Last 6 months',
                    },
                },
            ],
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
                component: 'card',
                heading: 'Heading',
                subHeading: 'Sub Heading',
                type: null,
                uriKey: 'card',
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

describe('Card', () => {
    it('should load the components', () => {
        const wrapper = factory();
        expect(wrapper.find('.v-card').vm).toBeTruthy();
    });

    it('should show the heading and sub-heading tooltip', () => {
        const wrapper = factory();
        expect(wrapper.find('.v-card__title').html()).toContain('Heading');
        expect(wrapper.find('.v-tooltip').vm).toBeTruthy();
    });

    it('should load the sparkline component', async () => {
        const wrapper = factory();
        await flushPromises();
        expect(wrapper.find('.lc-sparkline').vm).toBeTruthy();
    });

    it('should show the correct data from api response', async () => {
        const wrapper = factory();
        await flushPromises();
        expect(wrapper.find('.line1').html()).toContain(100);
        expect(wrapper.find('.line2').html()).toContain(50);
        expect(wrapper.find('.trend').html()).toContain('100%');
        expect(wrapper.find('.lc-custom-html').html()).toContain('custom html component');
    });
});
