const PAGES = [
    '/user',
    '/medical-file',
    '/medicine-type',
    '/medicine',
    '/blog',
    '/contact',
    '/calendar'
];

export default class Menu {
    private currentUrl: string;

    constructor() {
        this.currentUrl = window.location.href;
    }

    public activeMenu() {
        $(() => {
            $('.nk-menu .nk-menu-item a').each((_, el) => {
                const href = $(el).attr('href') ?? '';
                const currentPage =
                    PAGES.find(page => this.currentUrl.includes(page)) ?? '';
                if (href.includes(currentPage)) {
                    $(el).parent().attr('class', 'active current-page');
                    return false;
                }
            });
        });
    }
}
