import { createLocalVue, mount } from '@vue/test-utils';
import Vuex from 'vuex';
import ExampleComponent from './ExampleComponent.vue';

const localVue = createLocalVue();
localVue.use(Vuex);

test('it works', () => {
    expect(1 + 1).toBe(2);
});

describe('ExampleComponent', () => {
    test('test case one', () => {
        const wrapper = mount(ExampleComponent, {
            localVue,
            propsData: {},
            mocks: {},
            stubs: {},
            methods: {},
        });

        expect(wrapper.find('.container').vm).toBeTruthy();
        expect(wrapper).toMatchSnapshot();
    });
});
