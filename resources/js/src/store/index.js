import { createStore } from 'vuex'

import loading from "./Loader";
import auth from "./Auth";


export default createStore({
    modules: {
        loading,
        auth
    }
});
