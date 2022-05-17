import Logout from './Logout';
import HistoryBack from './HistoryBack';
import Menu from './Menu';

const logout = new Logout();
logout.render();

const historyBack = new HistoryBack();
historyBack.back();

const menu = new Menu();
menu.activeMenu();
