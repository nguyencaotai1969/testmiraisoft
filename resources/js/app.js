import Vue from 'vue';
import VueRouter from 'vue-router'; // Không cần import VueRouter ở đây
import Vuex from 'vuex';

import Filemanager from './page/filemanager/FileComponent.vue';

import App from './page/AppFilemanager.vue';

//lib
import Vuetable from 'vuetable-2/src/components/Vuetable.vue';
import VuetablePagination from 'vuetable-2/src/components/VuetablePagination.vue';
import VuetablePaginationDropDown from 'vuetable-2/src/components/VuetablePaginationDropDown.vue';
import VuetablePaginationInfo from 'vuetable-2/src/components/VuetablePaginationInfo.vue';
import VuetableFieldCheckbox from 'vuetable-2/src/components/VuetableFieldCheckbox.vue';
import Menu from './components/filemanager/MenuComponent.vue';

// component
Vue.component('Menu', Menu);
Vue.component('vuetable', Vuetable);  // Đảm bảo rằng tên component là 'vuetable'
Vue.component('vuetable-pagination', VuetablePagination);
Vue.component('vuetable-pagination-dropdown', VuetablePaginationDropDown);
Vue.component('vuetable-pagination-info', VuetablePaginationInfo);
Vue.component('vuetable-field-checkbox', VuetableFieldCheckbox);

// #store
//store file manager
import storeFilemanager from "./store/storeFileManager.js";

// use
Vue.use(VueRouter);
Vue.use(Vuex);


//tao store 
const store = new Vuex.Store({
    
    modules: {
        storeFilemanager
    },
});

const router = new VueRouter({
  mode: 'history',
  routes: [
    {
      path: '/',
      name: 'Filemanager',
      component: Filemanager,
    },
  ],
});

const app = new Vue({
  el: '#app',
  components: { App },
  router,
  store,
});

export default router;
