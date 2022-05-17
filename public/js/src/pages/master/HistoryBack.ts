export default class HistoryBack {
    public back() {
        $('.js-btn-back').on('click', () => {
            history.back();
        });
    }
}
