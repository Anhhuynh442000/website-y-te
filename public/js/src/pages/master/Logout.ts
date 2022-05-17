import { logout } from './services/services';

const SELECTOR_LOGOUT = '.js-logout';

export default class Logout {
    private bindEvent() {
        $(SELECTOR_LOGOUT).on('click', () => {
            this.handleLogout();
        });
    }

    private handleLogout() {
        logout().then(() => {
            window.location.replace('/admin/login');
        });
    }

    public render() {
        this.bindEvent();
    }
}
