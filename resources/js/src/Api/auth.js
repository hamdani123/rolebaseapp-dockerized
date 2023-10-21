import { Api } from './index';

export default {
    async getAuthData() {
        return await Api.get('auth/user');
    },
    login(user) {
        return Api.post('login', {
            email: user.email,
            password: user.password
        });
    },
}
